<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    function update(Request $request) {
        $input = $request->all();
        $user = auth()->user();
        if ($file = $request->file('image')) {
            if ($user->photo != null) Storage::delete('public/images/'. $user->photo);
            $imgname = time() . $file->getClientOriginalName();
            Storage::putFileAs('public/images',$file,$imgname);
            $input['image'] = $imgname;
        }
        $user->update($input);

        if ($request['type_role'] == "Business") {
            $user->business->update($input);
        }
        else if ($request['type_role'] == "Influencer") {
//            $user->influencer->update($input);
            //isi table influenceranalytic
        }

        return response()->json([
           'code'=>201,
            'message' => 'success'
        ]);
    }

    function getUserProfile($user_id) {
        $user = User::find($user_id);
        $user['photo'] = Utility::$imagePath . $user['photo'];

        return $user;
    }
}
