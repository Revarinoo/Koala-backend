<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BusinessController extends Controller
{
    function updateBusinessProfile(Request $request) {
        $input = $request->all();
        $user = auth()->user();
        $business = Business::where('user_id', $user->id)
                    ->join('users', 'users.id', '=', 'businesses.user_id')
                    ->first();
                    
        if($business != null){
            if ($file = $request->file('image')) {
                if ($business->business_photo != null) Storage::delete('public/images/'. $business->business_photo);
                $imgname = time() . $file->getClientOriginalName();
                Storage::putFileAs('public/images',$file,$imgname);
                $input['image'] = $imgname;
            }

            $business->update($input);

            return response()->json([
                'code'=>201,
                'message' => 'success'
            ], 201);
        }
        return response()->json([
            'code'=>401,
            'message' => 'failed'
         ], 401);
    }
}
