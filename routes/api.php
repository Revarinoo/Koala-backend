<?php

use App\Http\Controllers\InfluencerController;
use App\Http\Controllers\RegisterController;
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
Route::get('/influencer/rate/{influencer}', [InfluencerController::class, 'getMinRate']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
