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

        $credentials = $request->all();

        if (Auth::attempt($credentials)) {
            $user = User::where('email',$request->email)->first();
            $token = $user->createToken('auth_token')->plainTextToken;

            $responses = [
                'user'=>$user,
                'token'=>$token
            ];
            return response($responses, 201);
        }
            return response()->json([
                'message' => 'The provided credentials do not match our records.'
            ], 401);
    }

    public function logout(){
        auth()->user()->tokens()->delete();
        return response()->json(['message'=>'Logged out'], 201);
    }

}
