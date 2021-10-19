<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\Business;
use App\Models\Influencer;
use App\Models\Platform;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    function registerUser(Request $request) {

        $user = User::where('email', $request['email'])->first();
        if($user != null) {
            return response()->json(['message'=>"Email already used for {$this->getRole($user)} "], 401);
        }

        $user = User::create([
            'name'=>$request['name'],
            'email'=>$request['email'],
            'password'=>bcrypt($request['password'])
        ]);
        if ($request['type_role'] == "Business") {
            $this->registerBusiness($user);
        }
        else if ($request['type_role'] == "Influencer") {
            $this->registerInfluencer($user, $request['platform_name'], $request['socialmedia_id']);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        $responses = [
            'code'=>201,
            'access_token'=>$token,
            'message'=>'Success'
        ];
        return response($responses, 201);
    }

    function registerBusiness(User $user) {
        Business::create([
            'user_id'=>$user->id
        ]);
    }

    function registerInfluencer(User $user, string $platformName, string $username) {
        $influencer = Influencer::create([
            'user_id'=>$user->id
        ]);

        Platform::create([
            'name'=>$platformName,
            'socialmedia_id'=>$username,
            'influencer_id'=>$influencer->id
        ]);
    }

    function getRole(User $user) {
        $role = "";
        if (Business::where('user_id', $user->id)->first() != null) {
            $role = $role . "Business";
        }
        if (Influencer::where('user_id', $user->id)->first() != null) {
            $role = $role . "Influencer";
        }
        return $role;
    }
}
