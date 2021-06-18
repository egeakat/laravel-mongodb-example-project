<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class TwitchAnalysis extends Model
{
    use HasFactory;

    protected $fillable = ['concurrent_viewers','top_viewercount','total_chat_messages', 'emote_data', 'total_ad_revenue'];

    public function user(){
            return $this->belongsTo(User::class);
        }
    }

