<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TwitchAnalysis;
use Illuminate\Support\Facades\Http;


class TwitchAnalysisController extends Controller
{
    //

    public function getAnalyses(){
        return  TwitchAnalysis::paginate();
    }

    public function createAnalysis(){
        if(!auth()->user()->twitchAuthData){
           return response()->json(['message'=>'unauthorized'], 401);
        } 
       
        $twitchResponse = Http::withHeaders([
            'Client-ID' => env('TWITCH_CLIENT_ID'),
            'Authorization' => 'OAuth ' . auth()->user()->twitchAuthData['access_token'],
            'Accept'=> 'application/vnd.twitchtv.v5+json'
        ])->get('https://api.twitch.tv/kraken/channel');
        
        $analysis = auth()->user()->twitchAnalyses()->create();
        $analysis->data = $twitchResponse->json();
        $analysis->save();

        return $analysis;
      
    }


   
}
