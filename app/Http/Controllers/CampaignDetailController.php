<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\ContentDetail;
use App\Models\ContentPhoto;
use App\Models\Utility;
use Illuminate\Http\Request;

class CampaignDetailController extends Controller
{
    public function getCampaignDetail($content_id) {
        $content = Content::where('id', $content_id)->first();
        $content_details = ContentDetail::where('content_id', $content_id)->get();
        $content['campaign_logo'] = Utility::$imagePath . $content['campaign_logo'];
        $content_references = $this->getCampaignPhoto($content_id);

        return response()->json([
            'campaign'=>$content,
            'campaign_details'=>$content_details,
            'references'=>$content_references,
            'message'=>"Success",
            'code'=> 201
        ]);
    }

    function getCampaignPhoto($content_id) {
        $data = array();
        $content_photos = ContentPhoto::where('content_id', $content_id)->get();
        foreach ($content_photos as $content_photo) {
            array_push($data, Utility::$imagePath . $content_photo->photo);
        }
        return $data;
    }
}
