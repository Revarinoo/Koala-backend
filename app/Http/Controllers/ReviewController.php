<?php

namespace App\Http\Controllers;

use App\Models\Review;
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
        return response()->json([
            'code'=>201,
            'message'=> "Success",
            'review'=> $review
        ]);
    }
}
