<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Content;
use App\Models\ContentPhoto;
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

        $content = Content::create([
            'instruction'=> $request['instruction'],
            'schedule'=>$request['schedule'],
            'business_id'=>$request['business_id']
        ]);

        $file = $request->file('image');
        $imgname = time() . $file->getClientOriginalName();
        Storage::putFileAs('public/images',$file,$imgname);

        ContentPhoto::create([
            'content_id'=>$content->id,
            'photo'=>$imgname
        ]);

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
            $temp->name = $content->name;
            $temp->photo = $this->getCampaignPhoto($content);
            $temp->schedule = $content->schedule;
            $temp->status = $this->getStatus($content->schedule);
            array_push($data, $temp);
        }
        return response()->json([
            'data'=>$data,
            'message'=>'Success',
            'code'=>201
        ]);
    }

    function getCampaignPhoto(Content $content) {
        $data = array();
        foreach ($content->contentPhoto as $photo) {
            array_push($data, $photo->photo);
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
    public $name;
    public $photo;
    public $schedule;
    public $status;
}
