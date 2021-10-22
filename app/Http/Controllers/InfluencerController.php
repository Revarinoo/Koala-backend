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

    public function getRecommendedInfluencers(Request $request){
        $data = array();
        $categories = ["","",""];
        $i=0;
        foreach ($request->categories as $category){
            $categories[$i++] = $category;
        }
        $influencers = DB::table('influencers')
            ->join('users', 'influencers.user_id', '=', 'users.id')
            ->join('categories', 'influencers.user_id', '=', 'categories.user_id')
            ->join('platforms', 'platforms.influencer_id', '=', 'influencers.id')
            ->select('influencers.id', 'influencers.user_id','users.name', 'users.photo', 'platforms.socialmedia_id', 'users.location', 'influencers.engagement_rate')
            ->where('categories.name', $categories[0])
            ->orWhere('categories.name', $categories[1])
            ->orWhere('categories.name', $categories[2])
            ->orderBy('engagement_rate', 'desc')
            ->distinct()
            ->take(5)
            ->get();
        
        foreach ($influencers as $influencer){
            $response = new InfluencerResponse();
            $response->influencer_id = $influencer->id;
            $response->influencer_name = $influencer->name;
            $response->influencer_photo = $influencer->photo;
            $response->price = $this->getMinRate($influencer->id);
            $response->location = $influencer->location;
            $response->engagement_rate = $influencer->engagement_rate;
            $response->categories = $this->getCategory($influencer->user_id);
            array_push($data, $response);
        }
        return response()->json(['rec_influencers'=>$data], 201);
    }

    public function getInfluencerDetail($influencer_id){
        $influencer = DB::table('influencers')
            ->join('users', 'influencers.user_id', '=', 'users.id')
            ->join('platforms', 'influencer.id', '=', 'platforms.influencer_id')
            ->join('orders', 'influencer.id', '=', 'order.influencer_id')
            ->get();
        return response()->json($influencer, 201);
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
