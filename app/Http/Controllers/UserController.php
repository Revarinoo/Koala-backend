<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Platform;
use App\Models\Product;
use App\Models\User;
use App\Models\Business;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\isEmpty;

class UserController extends Controller
{
    function update(Request $request) {
        $input = $request->all();
        $user = auth()->user();
    
        if ($request['type_role'] == "Business") {
            $business = Business::where('user_id', $user->id)
                    ->first();
                    
            if($business != null){
                if ($file = $request->file('business_photo')) {
                    if ($business->business_photo != null) Storage::delete('public/images/'. $business->business_photo);
                    $imgname = time() . "_" . $business->business_name . "_" . $business->id . ".jpeg";
                    
                    Storage::putFileAs('public/images',$file,$imgname);
                    $input['business_photo'] = $imgname;
                }

                $business->update([
                    'business_name' => $input['business_name'],
                    'website' => $input['website'],
                    'instagram' => $input['instagram'],
                    'business_photo' => $input['business_photo']
                ]);

                $user->update([
                    'location' => $input['location'],
                    'description' => $input['description']
                ]);
                return response()->json([
                    'code'=>201,
                    'message' => 'success'
                ], 201);
            }
            
        }
        else if ($request['type_role'] == "Influencer") {
            $user->influencer->update($input);
            $categories = $request['categories'];
            $old_categories = Category::where('user_id', $user->id)->get();
            if (!$old_categories->isEmpty()) {
                foreach ($old_categories as $old) {
                    $old->delete();
                }
            }
            foreach ($categories as $category) {
                Category::create([
                    'name'=> $category,
                    'user_id'=>$user->id
                ]);
            }
            $platform = Platform::where('influencer_id', $user->influencer->id)->first();
            $platform->update([
                'socialmedia_id'=>$request['socialmedia_id']
            ]);

            $products = Product::where('influencer_id', $user->influencer->id)->first();
            if ($products == null) {
                Product::create([
                    'product_type'=> "Instagram Post",
                    'min_rate'=> $request['post_min_rate'],
                    'max_rate'=> $request['post_max_rate'],
                    'influencer_id'=>$user->influencer->id,
                    'platform_id' => $user->influencer->platform->id
                ]);
                Product::create([
                    'product_type'=> "Instagram Story",
                    'min_rate'=> $request['story_min_rate'],
                    'max_rate'=> $request['story_max_rate'],
                    'influencer_id'=>$user->influencer->id,
                    'platform_id' => $user->influencer->platform->id
                ]);
                Product::create([
                    'product_type'=> "Instagram Reels",
                    'min_rate'=> $request['reels_min_rate'],
                    'max_rate'=> $request['reels_max_rate'],
                    'influencer_id'=>$user->influencer->id,
                    'platform_id' => $user->influencer->platform->id
                ]);
            }

            else {
                $product_post = Product::where('influencer_id', $user->influencer->id)->where('product_type', "Instagram Post")->first();
                $product_post->update([
                    'min_rate'=> $request['post_min_rate'],
                    'max_rate'=> $request['post_max_rate']
                ]);

                $product_story = Product::where('influencer_id', $user->influencer->id)->where('product_type', "Instagram Story")->first();
                $product_story->update([
                    'min_rate'=> $request['story_min_rate'],
                    'max_rate'=> $request['story_max_rate']
                ]);

                $product_reels = Product::where('influencer_id', $user->influencer->id)->where('product_type', "Instagram Reels")->first();
                if($product_reels){
                    $product_reels->update([
                        'min_rate'=> $request['reels_min_rate'],
                        'max_rate'=> $request['reels_max_rate']
                    ]);
                }
            }
            return response()->json([
                'code'=>201,
                 'message' => 'success'
             ]);

        }else{
            if ($file = $request->file('image')) {
                if ($user->photo != null) Storage::delete('public/images/'. $user->photo);
                $imgname = time() . $file->getClientOriginalName();
                Storage::putFileAs('public/images',$file,$imgname);
                $input['photo'] = $imgname;
            }
            $user->update($input);
        }
        return response()->json([
            'code'=>401,
            'message' => 'failed'
        ], 401);
       
    }

    function getUserProfile($user_id) {
        $user = User::find($user_id);
        $user['photo'] = Utility::$imagePath . $user['photo'];

        return $user;
    }
}
