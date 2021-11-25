<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Utility;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    function insertReview(Request $request) {
        $review = Review::where('order_id', $request['order_id'])->first();
        if ($review != null) { return response()->json([
            'message'=>'Already reviewed',
            'code'=>401
        ]);
        }
        Review::create([
           'comment'=>$request['comment'],
            'rating'=>$request['rating'],
            'order_id'=>$request['order_id']
        ]);
        return response()->json([
            'message'=>'Success',
            'code'=>201
        ]);
    }

    function getReview($order_id) {
        $review = Review::where('order_id', $order_id)->first();
        if ($review->order->content->business->business_photo == null) {
            $review->order->content->business->business_photo = Utility::$imagePath . "default.png";
        }
        $business = array(
            'photo'=>$review->order->content->business->business_photo,
            'name' => $review->order->content->business->business_name
        );
        $review_data = array(
            'comment'=>$review->comment,
            'rating'=>$review->rating
        );
        return response()->json([
            'code'=>201,
            'message'=> "Success",
            'review'=> $review_data,
            'business'=>$business
        ]);
    }
}
