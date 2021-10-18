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
            ->select('influencers.id as influencer_id', 'users.location', 'users.name', 'users.photo', 'users.id as user_id', 'influencers.engagement_rate', 'influencers.rating')
            ->get();

        foreach ($platforms as $platform) {
            $obj = new InfluencerResponse();
            if (($categories = $this->getCategory($platform->user_id)) != null) {
                $obj->influencer_id = $platform->influencer_id;
                $obj->influencer_name = $platform->name;
                $obj->influencer_photo = $platform->photo;
                $obj->price = $this->getMinRate($platform->influencer_id);
                $obj->engagement_rate = $platform->engagement_rate;
                $obj->categories = $categories;
                $obj->location = $platform->location;
                $obj->rating = $platform->rating;
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
    public $influencer_name;
    public $influencer_photo;
    public $price;
    public $location;
    public $rating;
    public $categories;
    public $engagement_rate;
}
