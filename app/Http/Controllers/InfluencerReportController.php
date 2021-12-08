<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Reporting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    function submitReport(Request $request) {
        $file = $request->file('post_photo');
        $img_name = time() . rand(201, 1000) . "." . $file->getClientOriginalExtension();
        Storage::putFileAs('public/images', $file, $img_name);

        $input = $request->all();
        $input['post_photo'] = $img_name;
        Reporting::create($input);

        $order_detail = OrderDetail::where('id', $request['order_detail_id'])->first();
        $order_detail->order->update([
            'status'=>"Completed"
        ]);

        return response()->json([
           'code'=>201,
           'message'=> "Success"
        ]);
    }
}
