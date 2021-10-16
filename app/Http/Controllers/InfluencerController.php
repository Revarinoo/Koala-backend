<?php

namespace App\Http\Controllers;

use App\Models\Influencer;
use App\Models\Platform;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InfluencerController extends Controller
{

    function getAllInfluencer() {
        $platforms = DB::table('influencers')
            ->join('platforms', 'influencers.id', '=', 'platforms.influencer_id')
            ->join('users', 'influencers.user_id', '=', 'users.id')
            ->join('categories', 'users.id', '=', 'categories.user_id')
            ->select('platforms.socialmedia_id', 'users.name', 'users.photo', 'categories.name as category')
            ->get();
        return response()->json([
            'data'=>$platforms
        ], 201);
    }

    function getMinRate(Influencer $influencer) {
        $rate = Product::where('influencer_id', $influencer->id)->get()->min('rate');

        return response()->json([
            'influencer_id'=>$influencer->id,
            'rate'=>$rate,
        ], 201);
    }

}
