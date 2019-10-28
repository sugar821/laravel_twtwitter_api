<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //書き込みができるようにする
    protected $fillable = ["user_id","tweet_id","body"];

    //review->tweet
    public function tweet(){
        return $this->belongsTo('App\Tweet', 'tweet_id', 'tweet_id');
    }
    //review->user
    public function user(){
        return $this->belongsTo('App\User');
    }
}
