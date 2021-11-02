<?php

use App\Http\Controllers\BusinessController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\InfluencerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [RegisterController::class, 'registerUser']);
Route::get('/influencers', [InfluencerController::class, 'getAllInfluencer']);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/recommended/influencers', [InfluencerController::class, 'getRecommendedInfluencers']);
Route::get('/influencers/{category}', [InfluencerController::class, 'getInfluencerByCategory']);
Route::post('/order/review',[ReviewController::class, 'insertReview']);
Route::get('/campaign/detail/{content_id}',[CampaignController::class, 'getCampaignDetail']);
Route::post('/campaign/detail/create', [CampaignController::class, 'createCampaignDetail']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/influencer/{influencer_id}', [InfluencerController::class, 'getInfluencerDetail']);
    Route::get('/business-report/{content_id}',[CampaignController::class, 'getBusinessReport']);
    Route::get('/business-report',[CampaignController::class, 'getAllBusinessReport']);
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::post('/profile/update', [UserController::class, 'update']);
    Route::get('/business/order', [OrderController::class, 'getOrder']);
    Route::get('/campaign',[CampaignController::class, 'getCampaign']);
    Route::post('/campaign/create', [CampaignController::class, 'createCampaign']);
});
