<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\TwitchAnalysis;
use App\Models\User;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

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