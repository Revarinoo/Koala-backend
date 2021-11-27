<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Reporting;
use Illuminate\Http\Request;

class InfluencerReportController extends Controller
{
    function createReport(Request $request) {
        Reporting::create($request->all());
        $order_detail = OrderDetail::where('id', $request['order_detail_id'])->first();
        $order_detail->order->update([
            'status'=>"Completed"
        ]);
        return response()->json([
            'code'=>201,
            'message' => 'Success'
        ]);
    }
}
