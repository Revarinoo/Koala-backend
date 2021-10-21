<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Business;
use App\Models\Influencer;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $user = auth()->user();
            if ($request['type_role'] == "Business") {

                $business_owner = Business::where('user_id', $user->id)->first();

                if ( $business_owner != null){
                    $token = $user->createToken('auth_token')->plainTextToken;
                    $responses = [
                        'code'=>201,
                        'access_token' => $token,
                        'message'=>'Success'
                    ];
                    return response($responses, 201);
                }
            }else if ($request['type_role'] == "Influencer") {

                $influencer = Influencer::where('user_id', $user->id)->first();

                if ( $influencer != null){
                    $token = $user->createToken('auth_token')->plainTextToken;
                    $responses = [
                        'code'=>201,
                        'access_token' => $token,
                        'message'=>'Success'
                    ];
                    return response($responses, 201);
                }
            }
        }
        return response()->json([
            'code'=>401,
            'message' => 'The provided credentials do not match our records.'
        ], 401);
    }

    public function logout(){
        auth()->user()->tokens()->delete();
        return response()->json(['message'=>'Logged out'], 201);
    }

}
