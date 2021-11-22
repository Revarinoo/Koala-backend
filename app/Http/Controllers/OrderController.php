<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Content;
use App\Models\Reporting;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
                $product_data->product_type = $detail->contentDetail->content_type;

                if ($detail->reporting != null) {
                    $product_data->reach = $detail->reporting->reach;
                    $product_data->impression = $detail->reporting->impressions;
                    $product_data->er = $this->calculateER($detail->reporting, $detail->order->influencer->platform->followers);
                }
                else {
                    $product_data->reach = 0;
                    $product_data->impression = 0;
                    $product_data->er = 0;
                }
            array_push($data, $product_data);
        }
        return $data;
    }

    private function calculateER(Reporting $reporting, int $followers) {
        return (($reporting->likes + $reporting->comments) / $followers) * 100;
    }

    public function createOrder(Request $request) {
        Order::create([
            'status'=>$request['status'],
            'order_date'=>$request['order_date'],
            'content_id'=>$request['content_id'],
            'influencer_id'=>$request['influencer_id']
        ]);

        return response([
            'message'=>"Success",
            'code'=>201
        ]);
    }

    public function rescheduleOrder(Request $request){

        $order = Order::find($request->order_id);

        if ($order != null && $request->dueDate != null){

            $date = Carbon::parse($request->dueDate)->format('Y-m-d');
            $order->order_date = $date;
            $order->save();

            return response([
                'code'=>201,
                'message'=>"Success",
                'order_id'=>$order->id,
                'dueDate'=> $order->order_date
            ]);

        }
        return response([
            'code'=>401,
            'message'=>"Failed"
        ]);
    }

    public function cancelOrder($order_id) {
        $order = Order::find($order_id);
        $order->delete();
        return response()->json([
            'code'=>201,
            'message'=>"Success"
        ]);
    }

    /**
	 * Checkout process and saving order data
	 *
	 * @param OrderRequest $request order data
	 *
	 * @return void
	 */
	public function doCheckout(Request $request)
	{
		// $params = $request->except('_token');

		$order = \DB::transaction(
			function () use ($request) {
				$order = Order::create([
                    'status'=> $request->status,
                    'order_date' => $request->order_date,
                    'content_id' => $request->content_id,
                    'influencer_id' => $request->influencer_id
                ]);
				// $this->_saveOrderItems($order);
				
	
				return $order;
			}
		);

		if ($order) {
		
			// \Session::flash('success', 'Thank you. Your order has been received!');
            $snap = $this->_generatePaymentToken($order);
            return response([
                'order'=>$order,
                'snap' => $snap,
                'message'=>"Success",
                'code'=>201
            ]);
			// return redirect('orders/received/'. $order->id);
		}
		return response([
            'order'=>$order,
            'message'=>"Failed",
            'code'=>401
        ]);
	}

    private function _generatePaymentToken($order){
        $this->initPaymentGateway();

        $customerDetails = [
            'first_name' => "Elon",
            'last_name' => "Musk",
            'email' => "claraanggraini_01@yahoo.com",
            'phone' => "082333534432"
        ];
        $params = [
            'enable_payments' => \App\Models\Payment::PAYMENT_CHANNELS,
            'transaction_details' => [
                'order_id' => 1,
                'gross_amount' => 10000
            ],
            'customer_details' => $customerDetails,
            'expiry' => [
                'start_time' => date('Y-m-d H:i:s T'),
                'unit' => \App\Models\Payment::EXPIRY_UNIT,
                'duration' => \App\Models\Payment::EXPIRY_DURATION
            ],
        ];
        $snap = \Midtrans\Snap::createTransaction($params);
        if ($snap->token) {
			$order->payment_token = $snap->token;
			$order->payment_url = $snap->redirect_url;
			$order->save();
		}
        return $snap;
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
