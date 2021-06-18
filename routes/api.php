<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\TwitchAnalysis;
use App\Models\User;
use App\Http\Controllers\AuthController;


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

});
Route::post('/signup', [AuthController::class, 'signup']);


Route::get('/', function () {
    //return view('welcome');
    
    return User::find('60ccb7e8b73abe4cec108132')->twitchAnalyses()->create([
        'concurrent_viewers' => 2000,
        'top_viewercount' => 6000,
        'total_chat_messages' =>2250,
        'emote_data' =>  ['top_emote' =>'PogChamp', 'total_emotes'=>12, 'emote_prefix' => 'ege'],
        'total_ad_revenue' => ['amount' => 100.21, 'currency'=>'$']
    ]);
    

});