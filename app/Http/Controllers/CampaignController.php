<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Content;
use App\Models\ContentPhoto;
use Illuminate\Http\Request;
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
}
