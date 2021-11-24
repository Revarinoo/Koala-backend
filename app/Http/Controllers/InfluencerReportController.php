<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Reporting;
use Illuminate\Http\Request;

class InfluencerReportController extends Controller
{
    function createReport(Request $request) {
//        $order_detail = OrderDetail::where('content')
        return response()->json([
            'code'=>201,
            'message' => 'Success'
        ]);
    }
}
