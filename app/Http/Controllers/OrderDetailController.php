<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Utility;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    function paymentOrderDetail($order_id) {
        $order = Order::where('id', $order_id)->first();
        $order->influencer->user->photo = Utility::$imagePath . $order->influencer->user->photo;

        $detail = array();
        foreach ($order->orderDetail as $data) {
            array_push($detail, array(
                'content_type'=>$data->contentDetail->content_type,
                'price'=>$data->price
            ));
        }

        return response()->json([
            'code'=>201,
            'message'=>"Success",
            'campaign_name'=> $order->content->name,
            'time_period' => date("d F Y", strtotime($order->content->start_date)) . " - " . date("d F Y", strtotime($order->content->end_date)),
            'detail'=> $detail,
            'influencer'=>$order->influencer->user
        ]);
    }

    function inputPrice(Request $request) {
        OrderDetail::where('id', $request['order_detail_id'])->update([
            'price'=>$request['price']
        ]);

        return response()->json([
            'code'=>201,
            'message'=> "Success",
        ]);
    }
}
