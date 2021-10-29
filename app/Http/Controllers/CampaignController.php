<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Content;
use App\Models\ContentPhoto;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;

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
}

class CampaignData {
    public $content_id;
    public $name;
    public $photo;
    public $schedule;
    public $status;
    public $type;
}
