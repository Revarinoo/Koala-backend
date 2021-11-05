<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Content;
use App\Models\ContentDetail;
use App\Models\ContentPhoto;
use App\Models\Order;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller
{
    function createCampaign(Request $request) {
        $user = auth()->user();
        $business = Business::where('user_id', $user->id)->first();
        if ($business == null) {
            return response()->json([
                'code'=> 404,
                'message'=>'User does not exist'
            ], 404);
        }

        if($request['campaign_logo'] != null) {
            $file = $request->file('campaign_logo');
            $imgname = time() . $file->getClientOriginalName();
            Storage::putFileAs('public/images',$file,$imgname);
        }
        else {
            $imgname = "default.png";
        }


        $content = Content::create([
            'name'=>$request['name'],
            'description'=> $request['description'],
            'schedule'=>$request['schedule'],
            'product_name'=> $request['product_name'],
            'rules'=>$request['rules'],
            'campaign_logo'=>$imgname,
            'business_id'=>$business->id
        ]);

        foreach ($request->file('references') as $reference) {
            $reference_name = time() . $reference->getClientOriginalName();
            Storage::putFileAs('public/images',$reference,$reference_name);

            ContentPhoto::create([
                'content_id'=>$content->id,
                'photo' => $reference_name
            ]);
        }

        return response()->json([
            'content_id'=> $content->id,
            'code'=>201,
            'message'=>'Success'
        ], 201);
    }

    function getCampaign() {
        $user = auth()->user()->business;
        $data = array();
        foreach ($user->content as $content) {
            $temp = new CampaignData();
            $temp->content_id = $content->id;
            $temp->name = $content->name;
            $temp->photo = Utility::$imagePath . $content->campaign_logo;
            $temp->schedule = $content->schedule;
            $temp->status = $this->getStatus($content->schedule);
            $temp->type = $this->getContentType($content->contentDetail);
            array_push($data, $temp);
        }
        return response()->json([
            'data'=>$data,
            'message'=>'Success',
            'code'=>201
        ]);
    }

    private function getContentType($content_details) {
        $data = array();
        foreach ($content_details as $content_detail) {
            array_push($data, $content_detail->content_type);
        }
        return $data;
    }

    private function getStatus($date) {
        $today = date('Y-m-d H:i:s');
        $today_time = strtotime($today);
        $expired = strtotime($date);
        if ($expired > $today_time) {
            return "Upcoming";
        }
        return "Completed";
    }

    public function getBusinessReport($content_id){
        $data = DB::table('contents')
            ->where('contents.id', $content_id)
            ->select('contents.name', 'contents.schedule', 'contents.campaign_logo')
            ->first();
            if ($data != null){
                $campaign_detail = new BusinessReportResponse();
                $campaign_detail->content_name = $data->name;
                $campaign_detail->dueDate = $data->schedule;
                $campaign_detail->campaign_logo = Utility::$imagePath . $data->campaign_logo;
                $campaign_detail->totalExpense = $this->getTotalExpense($content_id);
                $campaign_detail->analytics = $this->getTotalReachImp($content_id);
                $campaign_detail->influencers = $this->getInfluencerReport($content_id);

                return response()->json([
                    'code'=>201,
                    'campaign_detail'=>$campaign_detail
                ]);
            }
            return response()->json([
                'code'=>401,
                'message'=>'Data does not exist.'
            ]);
    }

    public function getTotalExpense($content_id){
        $totalExpense = DB::table('contents')
            ->join('orders', 'contents.id', '=', 'orders.content_id')
            ->join('order_details', 'order_details.order_id', '=', 'orders.id')
            ->where('contents.id', $content_id)
            ->sum('order_details.price');

            return $totalExpense;
    }

    public function getTotalReachImp($content_id){
        $data = DB::table('orders')
            ->join('order_details', 'order_details.order_id', 'orders.id')
            ->join('reportings', 'reportings.order_detail_id', '=', 'order_details.id')
            ->join('content_details', 'order_details.content_detail_id', '=', 'content_details.id')
            ->where('orders.content_id', $content_id)
            ->select('content_details.content_type',DB::raw("SUM(reach) as total_reach"),
            DB::raw("SUM(impressions) as total_imp"))
            ->groupBy('order_details.content_detail_id', 'content_details.content_type')
            ->get();

        if ($data->isEmpty()) {
            return array(
                'content_type'=>0,
                'total_reach'=>0,
                'total_imp'=>0
            );
        }
        return $data;
    }

    public function getInfluencerReport($content_id){
        $arr = array();
        $data = DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('influencers', 'orders.influencer_id', '=', 'influencers.id')
            ->join('reportings', 'reportings.order_detail_id', '=', 'order_details.id')
            ->join('users', 'users.id', '=', 'influencers.user_id')
            ->where('orders.content_id', $content_id)
            ->select('influencers.id as influencer_id', 'users.name', 'users.photo', DB::raw("SUM(order_details.price) as total_price"),
            DB::raw("SUM(reportings.likes) as total_likes"), DB::raw("SUM(reportings.comments) as total_comments"))
            ->groupBy('users.name', 'influencers.id', 'users.photo')
            ->get();

        foreach($data as $d){
            $d->photo = Utility::$imagePath . $d->photo;
            $followers = $this->getFollowersCount($d->influencer_id);
            $engagement_rate = $this->getEngagementRate($d->influencer_id);
            $engagement_rate /= $followers;
            $engagement_rate *= 100;
            $d->engagement_rate = number_format((double)$engagement_rate, 2, '.', '');

            array_push($arr, $d);
        }

        if ($arr == []) {
            $order = Order::where('content_id', $content_id)->first();
            return array(
                'influencer_id'=>$order->influencer->id,
                'name'=>$order->influencer->name,
                'photo'=> Utility::$imagePath . $order->influencer->user->photo,
                'total_price'=>$order->orderDetail->sum('price'),
                'total_likes'=>0,
                'total_comments'=>0,
                'engagement_rate'=>0
            );
        }

        return $arr;
    }

    public function getEngagementRate($influencer_id){
        $data = DB::table('orders')
            ->join('order_details', 'order_details.order_id', '=', 'orders.id')
            ->join('content_details', 'order_details.content_detail_id', '=', 'content_details.id')
            ->join('reportings', 'reportings.order_detail_id', '=', 'order_details.id')
            ->where('orders.influencer_id', $influencer_id)
            ->where('content_details.content_type', 'Instagram Post')
            ->select(DB::raw("AVG(reportings.likes) as avg_likes"), DB::raw("AVG(reportings.comments) as avg_comments"))
            ->groupBy('orders.influencer_id')
            ->first();

            $total_average = $data->avg_likes + $data->avg_comments;

            return $total_average;
    }

    public function getFollowersCount($influencer_id){
        $followers = DB::table('platforms')
        ->join('influencers', 'influencers.id', '=', 'platforms.influencer_id')
        ->where('influencers.id', $influencer_id)
        ->select('platforms.followers as follower_count')
        ->first();
        return (double) $followers->follower_count;
    }

    public function getAllBusinessReport(){
        $user = auth()->user();
        $business = DB::table('businesses')
            ->where('businesses.user_id', $user->id)
            ->first();
        $reports = DB::table('contents')
            ->join('orders', 'contents.id', '=', 'orders.content_id')
            ->join('order_details', 'order_details.order_id', '=', 'orders.id')
            ->select('orders.content_id', 'contents.name', 'contents.campaign_logo','contents.schedule', DB::raw("SUM(order_details.price) as campaign_price"))
            ->where('contents.business_id', $business->id)
            ->groupBy('orders.content_id', 'contents.name', 'contents.schedule', 'contents.campaign_logo')
            ->get();

        if ($reports != null){
            $total_expense = 0;
            foreach($reports as $r){
                $r->campaign_logo = Utility::$imagePath . $r->campaign_logo;
                $total_expense += $r->campaign_price;
            }

            return response()->json([
                'reports'=>$reports,
                'total_expense'=>$total_expense,
                'code'=>201
            ]);
        }
        return response()->json([
            'message'=>'Data does not exist.',
            'code'=>401
        ]);
    }

    public function getCampaignDetail($content_id) {
        $content_details = ContentDetail::where('content_id', $content_id)->get();
        if ($content_details->count() == 0){
            return response()->json([
                'data'=>$content_details,
                'message'=>"Campaign does not exist",
                'code'=>404
            ]);
        }

        return response()->json([
           'data'=>$content_details,
            'message'=>"Success",
            'code'=>201
        ]);
    }

    public function createCampaignDetail(Request $request) {
        ContentDetail::create([
            'content_id'=>$request['content_id'],
            'content_type'=>$request['content_type'],
            'instruction'=>$request['instruction']
        ]);

        return response()->json([
            'message'=>"Success",
            'code'=>201
        ]);
    }
}

class BusinessReportResponse{
    public $content_name;
    public $dueDate;
    public $campaign_logo;
    public $totalExpense;
    public $analytics;
    public $influencers;
}

class CampaignData {
    public $content_id;
    public $name;
    public $photo;
    public $schedule;
    public $status;
    public $type;
}
