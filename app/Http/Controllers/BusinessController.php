<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BusinessController extends Controller
{
    public function getBusinessProfile(){
        $user = auth()->user();
        $business = Business::where('user_id', $user->id)->first();
        if($business != null){
            return response([
                'business_photo'=>Utility::$imagePath . $business->business_photo,
                'business_name'=>$business->business_name,
                'location'=>$user->location,
                'instagram'=>$business->instagram,
                'website'=>$business->website,
                'description'=>$user->description,
                'message'=>'Success',
                'code'=>201
            ],201);
        } 

        return response([
            'message'=>"User does not exist",
            'code'=>401
        ], 401);
    }
}
