<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Reporting;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function getOrder() {
        $user = auth()->user();
        $datas = DB::table('businesses')
            ->where('businesses.user_id', '=', $user->id)
            ->join('contents', 'businesses.id', '=', 'contents.business_id')
            ->join('orders', 'contents.id', '=', 'orders.content_id')
            ->join('influencers', 'orders.influencer_id', '=', 'influencers.id')
            ->join('users', 'influencers.user_id', '=', 'users.id')
            ->select('orders.id as order_id', 'users.name as influencer_name', 'users.photo as influencer_photo',
                'contents.id as content_id', 'orders.order_date', 'orders.status')
            ->get();

        $response_data = array();
        foreach ($datas as $data) {
            $temp = new BusinessOrder();
            $temp->order_id = $data->order_id;
            $temp->influencer_name = $data->influencer_name;
            $temp->influencer_photo = Utility::$imagePath . $data->influencer_photo;
            $temp->content_id = $data->content_id;
            $temp->order_date = $data->order_date;
            $temp->status = $data->status;
            $temp->product_data = $this->getProductData($data->order_id);
            array_push($response_data, $temp);
        }

        return response()->json([
            'data'=>$response_data,
            'message'=>'Success',
            'code'=>201
        ]);
    }

    private function getProductData(int $order_id) {
        $data = array();
        $details = OrderDetail::where('order_id', $order_id)->get();
        foreach ($details as $detail) {
            $product_data = new ProductData();
            if ($detail->reporting != null) {
                $product_data->product_type = $detail->contentDetail->content_type;
                if ($detail->reporting != null) {
                    $product_data->reach = $detail->reporting->reach;
                    $product_data->impression = $detail->reporting->impressions;
                    $product_data->er = $this->calculateER($detail->reporting, $detail->order->influencer->platform->followers);
                    array_push($data, $product_data);
                }
                else {
                    array_push($data, $detail->contentDetail->content_type);
                }
            }
        }
        return $data;
    }

    private function calculateER(Reporting $reporting, int $followers) {
        return (($reporting->likes + $reporting->comments) / $followers) * 100;
    }
}

class BusinessOrder {
    public $order_id;
    public $influencer_name;
    public $influencer_photo;
    public $content_id;
    public $order_date;
    public $status;
    public $product_data;
}

class ProductData {
    public $product_type;
    public $reach;
    public $impression;
    public $er;
}
