<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\InfluencerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

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
Route::post('/create-campaign', [CampaignController::class, 'createCampaign']);
Route::get('/recommended/influencers', [InfluencerController::class, 'getRecommendedInfluencers']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout']);
});
