<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Content;
use App\Models\ContentPhoto;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller
{
    function createCampaign(Request $request) {

        $business = Business::where('id', $request['business_id'])->first();
        if ($business == null) {
            return response()->json([
                'code'=> 401,
                'message'=>'User not available'
            ], 401);
        }


        $file = $request->file('campaign_logo');
        $imgname = time() . $file->getClientOriginalName();
        Storage::putFileAs('public/images',$file,$imgname);

        $content = Content::create([
            'name'=>$request['name'],
            'description'=> $request['description'],
            'instruction'=> $request['instruction'],
            'schedule'=>$request['schedule'],
            'product_campaign'=>$request['product_campaign'],
            'rules'=>$request['rules'],
            'type'=>$request['type'],
            'campaign_logo'=>$imgname,
            'business_id'=>$request['business_id']
        ]);



//        ContentPhoto::create([
//            'content_id'=>$content->id,
//            'photo'=>$imgname
//        ]);

        return response()->json([
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

    function getCampaignPhoto(Content $content) {
        $data = array();
        foreach ($content->contentPhoto as $photo) {
            array_push($data, Utility::$imagePath . $photo->photo);
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
            ->select('contents.name', 'contents.schedule')
            ->first();
            if ($data != null){
                $campaign_detail = new BusinessReportResponse();
                foreach($data as $d){
                    $campaign_detail->content_name = $data->name;
                    $campaign_detail->dueDate = $data->schedule;
                    $campaign_detail->totalExpense = $this->getTotalExpense($content_id);
                    $campaign_detail->analytics = $this->getTotalReachImp($content_id);
                    $campaign_detail->influencers = $this->getInfluencerReport($content_id);
                } 
                
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
            
            return $data;
    }

    public function getInfluencerReport($content_id){
        $data = DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('influencers', 'orders.influencer_id', '=', 'influencers.id')
            ->join('reportings', 'reportings.order_detail_id', '=', 'order_details.id')
            ->join('users', 'users.id', '=', 'influencers.user_id')
            ->where('orders.content_id', $content_id)
            ->select('users.name', DB::raw("SUM(order_details.price) as total_price"),
            DB::raw("SUM(reportings.likes) as total_likes"), DB::raw("SUM(reportings.comments) as total_comments"))
            ->groupBy('users.name')
            ->get();
            return $data;
    }
}

class BusinessReportResponse{
    public $content_name;
    public $dueDate;
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
