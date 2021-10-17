<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Influencer;
use App\Models\Platform;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InfluencerController extends Controller
{

    function getAllInfluencer() {
        $data = array();
        $platforms = DB::table('influencers')
            ->join('platforms', 'influencers.id', '=', 'platforms.influencer_id')
            ->join('users', 'influencers.user_id', '=', 'users.id')
            ->select('influencers.id as influencer_id','platforms.socialmedia_id', 'users.name', 'users.photo', 'users.id as user_id', 'influencers.engagement_rate')
            ->get();

        foreach ($platforms as $platform) {
            $obj = new InfluencerResponse();
            if (($categories = $this->getCategory($platform->user_id)) != null) {
                $obj->influencer_id = $platform->influencer_id;
                $obj->influencer_name = $platform->name;
                $obj->socialmedia_id = $platform->socialmedia_id;
                $obj->influencer_photo = $platform->photo;
                $obj->rate = $this->getMinRate($platform->influencer_id);
                $obj->engagement_rate = $platform->engagement_rate;
                $obj->categories = $categories;
                array_push($data, $obj);
            }
        }

        return response()->json([
            'data'=>$data
        ], 201);
    }

    function getMinRate(int $id) {
        $rate = Product::where('influencer_id', $id)->get()->min('rate');
        return $rate;
    }

    function getCategory(int $id) {
        $data = array();
        $categories = Category::where('user_id', $id)->get();
        foreach ($categories as $category) {
            array_push($data, $category->name);
        }
        return $data;
    }

}


class InfluencerResponse {
    public $influencer_id;
    public $socialmedia_id;
    public $influencer_name;
    public $influencer_photo;
    public $rate;
    public $categories;
    public $engagement_rate;
}
