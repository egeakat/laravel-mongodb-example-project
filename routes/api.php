<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\TwitchAnalysis;
use App\Models\User;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TwitchAnalysisController;
use App\Http\Controllers\TwitchController;


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


Route::group([

    'middleware' => 'api',
], function ($router) {

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/me', [AuthController::class, 'me']);
    Route::post('/twitch-logout', [TwitchController::class, 'twitchLogout']);


});
Route::post('/signup', [AuthController::class, 'signup']);
Route::get('/twitch-redirect', [TwitchController::class, 'twitchRedirect']);
Route::get('/twitch-login', [TwitchController::class, 'twitchLogin']);

Route::get('/get-analyses', [TwitchAnalysisController::class, 'getAnalyses'])->middleware('auth');
Route::post('/request-analysis', [TwitchAnalysisController::class, 'createAnalysis'])->middleware('auth');

Route::get('/', function () {
    return response()->json(['message'=>'success']);
    

    

});