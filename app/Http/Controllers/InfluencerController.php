<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\OrderDetail;
use App\Models\Influencer;
use App\Models\Platform;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Utility;

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
                $obj->influencer_photo = Utility::$imagePath . $platform->photo;
                $obj->price = $this->getMinRate($platform->influencer_id);
                $obj->engagement_rate = $platform->engagement_rate;
                $obj->categories = $categories;
                $obj->location = $platform->location;
                $obj->rating = $platform->rating;
                array_push($data, $obj);
            }
        }

        return response()->json([
            'data'=>$data,
            'message'=>'Success',
            'code'=>201
        ], 201);
    }

    function getMinRate(int $id) {
        $rate = Product::where('influencer_id', $id)->get()->min('min_rate');
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

        if ($influencers->isEmpty()) {
            $influencers = $this->getRandomRecommendation();
        }

        foreach ($influencers as $influencer){
            $response = new InfluencerResponse();
            $response->influencer_id = $influencer->id;
            $response->influencer_name = $influencer->name;
            $response->influencer_photo = Utility::$imagePath . $influencer->photo;
            $response->price = $this->getMinRate($influencer->id);
            $response->location = $influencer->location;
            $response->engagement_rate = $influencer->engagement_rate;
            $response->categories = $this->getCategory($influencer->user_id);
            array_push($data, $response);
        }
        return response()->json(['rec_influencers'=>$data], 201);
    }

    private function getRandomRecommendation() {
        $influencers = DB::table('influencers')
            ->join('users', 'influencers.user_id', '=', 'users.id')
            ->join('categories', 'influencers.user_id', '=', 'categories.user_id')
            ->join('platforms', 'platforms.influencer_id', '=', 'influencers.id')
            ->select('influencers.id', 'influencers.user_id','users.name', 'users.photo', 'platforms.socialmedia_id', 'users.location', 'influencers.engagement_rate')
            ->orderBy('engagement_rate', 'desc')
            ->distinct()
            ->get();
        $data = array_rand($influencers->toArray(), 4);
        $rand = array($influencers[$data[0]], $influencers[$data[1]], $influencers[$data[2]], $influencers[$data[3]]);
        return $rand;
    }

    public function getInfluencerDetail($influencer_id){
        $influencer = DB::table('influencers')
            ->join('users', 'influencers.user_id', '=', 'users.id')
            ->where('influencers.id', $influencer_id)
            ->select('influencers.id', 'influencers.contact_email','users.name', 'users.location', 'influencers.rating','users.photo', 'influencers.user_id', 'influencers.engagement_rate')
            ->first();
        if($influencer != null){
            $influencer_detail = new InfluencerDetailResponse();
            $influencer_detail->influencer_profile = $influencer;
            $influencer_detail->influencer_profile->photo = Utility::$imagePath . $influencer->photo;
            $influencer_detail->categories = $this->getCategory($influencer->user_id);
            $influencer_detail->platforms = $this->getPlatforms($influencer_id);
            $influencer_detail->projects = $this->getProjects($influencer_id);
            $influencer_detail->products = $this->getProductPrice($influencer_id);
            return response()->json($influencer_detail, 201);
        }

        return response()->json([
            'code'=>401,
            'message'=>'User does not exist'
        ]);
    }

    public function getInfluencerAnalytics($influencer_id){
        $analytic_photos = DB::table('influencers')
            ->join('influencer_analytics', 'influencers.id', '=', 'influencer_analytics.influencer_id')
            ->where('influencer_analytics.influencer_id', $influencer_id)
            ->select('influencer_analytics.id', 'influencer_analytics.photo')
            ->get();

            foreach($analytic_photos as $a){
                $a->photo = Utility::$imagePath . $a->photo;
            }

        return $analytic_photos;
    }

    public function getPlatforms($influencer_id){

        $platforms = DB::table('platforms')
            ->join('influencers', 'influencers.id', '=', 'platforms.influencer_id')
            ->where('platforms.influencer_id', $influencer_id)
            ->select('platforms.id', 'platforms.name', 'platforms.socialmedia_id', 'platforms.followers', 'platforms.average_likes', 'platforms.average_comments')
            ->get();

        return $platforms;
    }

    public function getProjects($influencer_id){
        $data = array();
        $order_details = array();

        $influencer_followers = Platform::where('influencer_id', $influencer_id)->first()->followers;

        $orders = DB::table('orders')
            ->join('contents', 'orders.content_id', '=', 'contents.id')
            ->join('reviews', 'orders.id', '=', 'reviews.order_id')
            ->join('businesses', 'businesses.id', '=', 'contents.business_id')
            ->join('users', 'users.id', '=', 'businesses.user_id')
            ->where('orders.influencer_id', $influencer_id)
            ->where('orders.status', 'Completed')
            ->select('orders.id','reviews.comment', 'businesses.business_name', 'businesses.business_photo')
            ->get();
        foreach($orders as $order){
            $project = new Project();
            $project->order_id = $order->id;
            $project->business_photo = Utility::$imagePath . $order->business_photo;
            $project->business_name = $order->business_name;
            $analytics = $this->getPortfolioAnalytics($order->id, $influencer_followers);
            $project->total_likes = $analytics->total_likes;
            $project->total_comments = $analytics->total_comments;
            $project->engagement_rate = number_format((double)$analytics->engagement_rate, 2, '.', '');
            $project->post_photo = Utility::$imagePath . $this->getPostPhoto($order->id)->post_photo;
            $project->comment = $order->comment;

            array_push($data, $project);
        }

        return $data;
    }

    public function getPortfolioAnalytics($order_id, $followers){
        $order_detail = OrderDetail::where('order_id', $order_id)
        ->join('reportings','order_details.id','=','reportings.order_detail_id')
        ->join('content_details', 'content_details.id', '=', 'order_details.content_detail_id')
        ->select(DB::raw("SUM(reportings.likes) as total_likes"), DB::raw("SUM(reportings.comments) as total_comments"), DB::raw("COUNT(order_details.id) as project_count"))
        ->where('content_details.content_type', 'Instagram Post')
        ->orWhere('content_details.content_type', 'Instagram Reels')
        ->groupBy('order_id')
        ->first();

        if($order_detail != null){
            $engagement_rate = $order_detail->total_likes+ $order_detail->total_comments;
            $engagement_rate /= $order_detail->project_count;
            $engagement_rate /= $followers;

            $order_detail->engagement_rate = $engagement_rate * 100;
        }
        return $order_detail;
    }

    public function getPostPhoto($order_id){
        $post_photo = OrderDetail::where('order_id', $order_id)
        ->join('reportings','order_details.id','=','reportings.order_detail_id')
        ->join('content_details', 'content_details.id', '=', 'order_details.content_detail_id')
        ->select('reportings.post_photo')
        ->where('content_details.content_type', 'Instagram Post')
        ->first();
        return $post_photo;
    }

    public function countSumImpression($order_id){
        $sum_impressions = DB::table('orders')
        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
        ->join('reportings', 'order_details.id', '=', 'reportings.order_detail_id')
        ->where('orders.id', $order_id)
        ->groupBy('orders.id')
        ->sum('reportings.impressions');
        return $sum_impressions;
    }

    public function countSumReach($order_id){
        $sum_reach = DB::table('orders')
        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
        ->join('reportings', 'order_details.id', '=', 'reportings.order_detail_id')
        ->where('orders.id', $order_id)
        ->groupBy('orders.id')
        ->sum('reportings.reach');
        return $sum_reach;
    }


    public function getInfluencerByCategory($category) {
        $data = array();
        $categories = Category::where('name', $category)->get();
        foreach ($categories as $list) {
            if ($list->user->influencer != null) {
                $influencer = new InfluencerResponse();
                $influencer->influencer_id = $list->user->influencer->id;
                $influencer->categories = $this->getCategory($list->user->id);
                $influencer->influencer_name = $list->user->name;
                $influencer->influencer_photo = Utility::$imagePath . $list->user->photo;
                $influencer->price = $this->getMinRate($list->user->influencer->id);
                $influencer->location = $list->user->location;
                $influencer->rating = $list->user->influencer->rating;
                $influencer->engagement_rate = $list->user->influencer->engagement_rate;
                array_push($data, $influencer);
            }
        }
        if ($data == null) { return response()->json(['code'=>404, 'message'=>'Data not found']);}
        return response()->json([
            'data'=>$data,
            'code'=>201,
            'message'=>'Success'
        ]);
    }

    public function getProductPrice($influencer_id) {
        $influencer = Influencer::where('id', $influencer_id)->first();
        $data = array();
        foreach ($influencer->product as $product) {
            $temp = array(
                'content_type'=>$product->product_type,
                'minPrice'=> $product->min_rate,
                'maxPrice'=> $product->max_rate
            );
            array_push($data, $temp);
        }
        return $data;
    }

    public function getInfluencerProfile() {
        $user = auth()->user();

        return response()->json([
            'code'=>201,
            'message'=>"Success",
            'influencer_name'=> $user->name,
            'photo'=> Utility::$imagePath . $user->photo,
            'email'=>$user->email,
            'instagram'=>$user->influencer->platform->socialmedia_id,
            'location'=>$user->location,
            'specialty'=>$user->category,
            'products'=>$user->influencer->product
        ]);
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
    public $products;
    public $projects;
}

class Project{
    public $order_id;
    public $total_likes;
    public $total_comments;
    public $engagement_rate;
    public $business_photo;
    public $business_name;
    public $post_photo;
    public $comment;
}
