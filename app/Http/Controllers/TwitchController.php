<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use App\Models\User;

use Illuminate\Http\Request;

class TwitchController extends Controller
{
    //
    public function twitchRedirect(Request $request){
      
        $responseTwitch = Http::post('https://id.twitch.tv/oauth2/token?client_id='. env('TWITCH_CLIENT_ID') .'&client_secret=' . env('TWITCH_CLIENT_SECRET'). '&code=' . $request->get('code') . '&grant_type=authorization_code&redirect_uri=http://localhost:8000/api/twitch-redirect');

        //@IMPORTANT!!!! This line of code was done as the request of twitchLogin has to be done from a browser (A.K.A frontend) so we don't have a reach to the authorized user. Don't forget to change this according to the authorized user using auth()->user() when you're implementing this project
        $user = User::where('email', 'egeakat@hotmail.com')->first();
        $user->twitchAuthData = $responseTwitch->json();
        $user->save();
        return redirect('/api');
        //$request->get('code')
        //return redirect('twitch-login-result');
    }

    public function twitchLogin(Request $request){
        
        return redirect('https://id.twitch.tv/oauth2/authorize?client_id='. env('TWITCH_CLIENT_ID').'&redirect_uri=http://localhost:8000/api/twitch-redirect&response_type=code&scope=channel_read');
        
    }

    public function twitchLogout(){
        auth()->user()->twitchAuthData = null;
        auth()->user()->save();
        return auth()->user();
    }
}
