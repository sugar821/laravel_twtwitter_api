<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    //書き込みができるようにする
    protected $fillable = ["tweet_id","tweet_user","tweet_avater","tweet_body"];

    public function reviews(){
        return $this->hasManany('App\Review');
    }

    public function favorites(){
        return $this->hasManany('App\Favorite');
    }
}
