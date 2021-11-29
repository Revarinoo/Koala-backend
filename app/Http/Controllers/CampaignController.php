<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Content;
use App\Models\ContentDetail;
use App\Models\ContentPhoto;
use App\Models\Order;
use App\Models\User;
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
            'start_date'=>$request['start_date'],
            'end_date'=>$request['end_date'],
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
            $temp->schedule = $content->end_date;
            $temp->status = $this->getStatus($content->end_date);
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
            ->select('contents.name', 'contents.end_date', 'contents.campaign_logo')
            ->first();
            if ($data != null){
                $campaign_detail = new BusinessReportDetailResponse();
                $campaign_detail->content_name = $data->name;
                $campaign_detail->end_date = $data->end_date;
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

        $arr = array();
        $arr = [
            [
                'content_type' => 'Instagram Post',
                'total_reach' => "0",
                'total_imp' => "0"
            ],
            [
                'content_type' =>'Instagram Story',
                'total_reach' => "0",
                'total_imp' => "0"
            ],
            [
                'content_type' => 'Instagram Reels',
                'total_reach' => "0",
                'total_imp' => "0"
            ]
        ];
        foreach($data as $d){
            if($d->content_type == "Instagram Post"){
                $arr[0] = [
                    'content_type'=>$d->content_type,
                    'total_reach' => $d->total_reach,
                    'total_imp'=> $d->total_imp,
                ];
            }if($d->content_type == "Instagram Story"){
                $arr[1] = [
                    'content_type'=>$d->content_type,
                    'total_reach' => $d->total_reach,
                    'total_imp'=> $d->total_imp,
                ];
            }if($d->content_type == "Instagram Reels"){
                $arr[2] = [
                    'content_type'=>$d->content_type,
                    'total_reach' => $d->total_reach,
                    'total_imp'=> $d->total_imp,
                ];
            }

        }
        return $arr;
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
            $d->engagement_rate = $this->getEngagementRate($d->influencer_id, $content_id);

            array_push($arr, $d);
        }

        if ($arr == []) {
            $order = Order::where('content_id', $content_id)->first();
            if ($order == null) {
                $temp_array = array(
                    'influencer_id'=>0,
                    'name'=>"",
                    'photo'=> "",
                    'total_price'=> 0,
                    'total_likes'=>"0",
                    'total_comments'=>"0",
                    'engagement_rate'=>"0"
                );
            }

            else {
                $temp_array = array(
                    'influencer_id'=>$order->influencer->id,
                    'name'=>$order->influencer->user->name,
                    'photo'=> Utility::$imagePath . $order->influencer->user->photo,
                    'total_price'=>$order->orderDetail->sum('price'),
                    'total_likes'=>"0",
                    'total_comments'=>"0",
                    'engagement_rate'=>"0"
                );
            }
            array_push($arr, $temp_array);
        }

        return $arr;
    }

    public function getEngagementRate($influencer_id, $content_id){
        $data = DB::table('orders')
            ->join('order_details', 'order_details.order_id', '=', 'orders.id')
            ->join('content_details', 'order_details.content_detail_id', '=', 'content_details.id')
            ->join('reportings', 'reportings.order_detail_id', '=', 'order_details.id')
            ->where('orders.influencer_id', $influencer_id)
            ->where('content_details.content_id', $content_id)
            ->where('content_details.content_type', 'Instagram Post')
            ->select(DB::raw("AVG(reportings.likes) as avg_likes"), DB::raw("AVG(reportings.comments) as avg_comments"))
            ->groupBy('order_details.order_id')
            ->first();

            $total_average = $data->avg_likes + $data->avg_comments;
            $followers = $this->getFollowersCount($influencer_id);
            $engagement_rate = $total_average / $followers;
            $engagement_rate *= 100;
            $engagement_rate = number_format((double)$engagement_rate, 2, '.', '');
            return $engagement_rate;
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
            ->join('reportings', 'reportings.order_detail_id', '=', 'order_details.id')
            ->select(DB::raw('YEAR(orders.updated_at) year, MONTH(orders.updated_at) month'), DB::raw("SUM(order_details.price) as total_price"), DB::raw("AVG(reportings.impressions) as avg_imp"), DB::raw("AVG(reportings.reach) as avg_reach"))
            ->where('contents.business_id', $business->id)
            ->groupBy('year', 'month')
            ->orderBy('year', 'ASC')
            ->orderBy('month', 'ASC')
            ->get();
            $result = array();
            if ($reports != null){
                $index = 0;
                foreach ($reports as $report){
                    $report->avg_er = $this->getAverageEngagementRate($business->id, $report->month, $report->year,);

                    $data = new BusinessReportResponse();
                    $avg_imp = new AverageImp();
                    $avg_reach = new AverageReach();
                    $avg_er = new AverageER();
                    $data->month = $report->month;
                    $data->total_expense = $report->total_price;
                    $overview = new OverviewData();

                    $avg_imp->data = number_format((double)$report->avg_imp, 2, '.', '');
                    $avg_reach->data = number_format((double)$report->avg_reach, 2, '.', '');
                    $avg_er->data = $report->avg_er;
                    if($index != 0){

                        $avg_imp->diff = $this->calculateDiffPercentage($reports[$index-1]->avg_imp,$report->avg_imp);
                        $avg_reach->diff = $this->calculateDiffPercentage($reports[$index-1]->avg_reach, $report->avg_reach,);

                        $avg_er->diff = number_format((double)$report->avg_er - $reports[$index-1]->avg_er, 2, '.', '');

                    }
                    $overview->avg_reach = $avg_reach;
                    $overview->avg_impression = $avg_imp;
                    $overview->avg_er = $avg_er;
                    $data->overview_data = $overview;
                    $index++;
                    array_push($result, $data);
                }
            return response()->json([
                'reports'=>$result,
                'code'=>201
            ]);
        }
        return response()->json([
            'message'=>'Data does not exist.',
            'code'=>401
        ]);
    }

    public function calculateDiffPercentage($avg_before, $avg_after){
        $diffPercentage = $avg_before - $avg_after;
        $diffPercentage /= $avg_before;
        $diffPercentage *= 100;
        $diffPercentage = number_format((double)$diffPercentage, 2, '.', '');
        return $diffPercentage;
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

    public function getAverageEngagementRate($business_id, $month, $year){

        $influencers = DB::table('orders')
            ->join('influencers', 'influencers.id', '=', 'orders.influencer_id')
            ->join('contents', 'contents.id', '=', 'orders.content_id')
            ->where('contents.business_id', $business_id)
            ->where('orders.status','Completed')
            ->whereYear('orders.updated_at', $year)
            ->whereMonth('orders.updated_at', $month)
            ->select('influencers.id as influencer_id', 'contents.id as content_id')
            ->get();

            $avg_er = 0;
            if($influencers != null){

                foreach ($influencers as $i){
                    $avg_er += $this->getEngagementRate($i->influencer_id, $i->content_id);
                }
                $avg_er/= count($influencers);
                $avg_er = number_format((double)$avg_er, 2, '.', '');
            }
        return $avg_er;
    }
}

class BusinessReportDetailResponse{
    public $content_name;
    public $end_date;
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

class BusinessReportResponse{
    public $month;
    public $total_expense;
    public $overview_data;
}

class OverviewData{
    public $avg_reach;
    public $avg_impression;
    public $avg_er;
}

class AverageImp{
    public $data;
    public $diff;
}

class AverageReach{
    public $data;
    public $diff;
}

class AverageER{
    public $data;
    public $diff;
}
