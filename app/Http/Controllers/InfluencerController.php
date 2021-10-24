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
        $data = array();
        
        $influencer = DB::table('influencers')
            ->join('users', 'influencers.user_id', '=', 'users.id')
            ->where('influencers.id', $influencer_id)
            ->select('influencers.id', 'users.name', 'users.location', 'users.photo', 'influencers.user_id')
            ->first();
        if($influencer != null){
            $influencer_detail = new InfluencerDetailResponse();
            $influencer_detail->influencer_profile = $influencer;
            $influencer_detail->categories = $this->getCategory($influencer->user_id);
            $influencer_detail->platforms = $this->getPlatforms($influencer_id);
            $influencer_detail->analytic_photos = $this->getInfluencerAnalytics($influencer_id);;
            $influencer_detail->projects = $projects = $this->getProjects($influencer_id);

            return response()->json($influencer_detail, 201);
        }
        return response()->json([
            'code'=>401,
            'message' => 'User does not exist.'
        ], 401);
    }

    public function getInfluencerAnalytics($influencer_id){
        $analytic_photos = DB::table('influencers')
            ->join('influencer_analytics', 'influencers.id', '=', 'influencer_analytics.influencer_id')
            ->where('influencer_analytics.influencer_id', $influencer_id)
            ->select('influencer_analytics.photo')
            ->get();

        return $analytic_photos;  
    }

    public function getPlatforms($influencer_id){

        $platforms = DB::table('platforms')
            ->join('influencers', 'influencers.id', '=', 'platforms.influencer_id')
            ->where('platforms.influencer_id', $influencer_id)
            ->get();

        return $platforms;
    }

    public function getProjects($influencer_id){
        $data = array();
        $order_details = array();
        
        $orders = DB::table('orders')
            ->join('contents', 'orders.content_id', '=', 'contents.id')
            ->join('reviews', 'orders.id', '=', 'reviews.order_id')
            ->join('businesses', 'businesses.id', '=', 'contents.business_id')
            ->join('users', 'users.id', '=', 'businesses.user_id')
            ->where('orders.influencer_id', $influencer_id)
            ->select('orders.id','users.photo', 'users.name', 'reviews.comment', 'reviews.rating', 'businesses.business_name')
            ->get();

        foreach($orders as $order){ 
            $project = new Project(); 
            $project->order_id = $order->id;
            $project->business_photo = $order->photo;
            $project->avg_impressions = $this->countAverageImpression($order->id);
            $project->avg_reach = $this->countAverageReach($order->id);
            $project->businessOwner_photo = $order->photo;
            $project->businessOwner_name = $order->name;
            $project->comment = $order->comment;
            $project->rating = $order->rating;
            array_push($data, $project);
        }

        return $data;
    }

    public function countAverageImpression($order_id){
        $avg_impressions = DB::table('orders')
        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
        ->join('reportings', 'order_details.report_id', '=', 'reportings.id')
        ->where('orders.id', $order_id)
        ->groupBy('orders.id')
        ->avg('reportings.impressions');
        return $avg_impressions; 
    }

    public function countAverageReach($order_id){
        $avg_reach = DB::table('orders')
        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
        ->join('reportings', 'order_details.report_id', '=', 'reportings.id')
        ->where('orders.id', $order_id)
        ->groupBy('orders.id')
        ->avg('reportings.reach');
        return $avg_reach; 
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

class InfluencerDetailResponse {
    public $influencer_profile;
    public $categories;
    public $platforms;
    public $analytic_photos;
    public $projects;
}

class Project{
    public $order_id;
    public $business_photo;
    public $avg_impressions;
    public $avg_reach;
    public $businessOwner_photo;
    public $businessOwner_name;
    public $comment;
    public $rating;
}