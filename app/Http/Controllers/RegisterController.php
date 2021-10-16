<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\Business;
use App\Models\Influencer;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    function registerUser(RegisterRequest $request) {

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
            $this->registerBusiness($user, $request['business_name']);
        }
        else if ($request['type_role'] == "Influencer") {
            $this->registerInfluencer($user, $request['contact_email']);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        $responses = [
            'user'=>$user,
            'type_role' => $request['type_role'],
            'access_token'=>$token
        ];

        return response($responses, 201);
    }

    function registerBusiness(User $user, string $businessName) {
        Business::create([
            'business_name'=>$businessName,
            'user_id'=>$user->id
        ]);
    }

    function registerInfluencer(User $user, string $contactEmail) {
        Influencer::create([
            'contact_email'=>$contactEmail,
            'user_id'=>$user->id
        ]);
    }

    function getRole(User $user) {
        $role = "";
        if (Business::where('user_id', $user->id)->first() != null) {
            $role = $role . "Business|";
        }
        if (Influencer::where('user_id', $user->id)->first() != null) {
            $role = $role . "Influencer";
        }
        return $role;
    }
}
