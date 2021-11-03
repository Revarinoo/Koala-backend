<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\ContentDetail;
use App\Models\Utility;
use Illuminate\Http\Request;

class CampaignDetailController extends Controller
{
    public function getCampaignDetail($content_id) {
        $content = Content::where('id', $content_id)->first();
        $content_details = ContentDetail::where('content_id', $content_id)->get();
        $content['campaign_logo'] = Utility::$imagePath . $content['campaign_logo'];
        return response()->json([
            'campaign'=>$content,
            'campaign_details'=>$content_details,
            'message'=>"Success",
            'code'=> 201
        ]);
    }
}
