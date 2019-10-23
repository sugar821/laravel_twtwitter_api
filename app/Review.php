<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //書き込みができるようにする
    protected $fillable = ["body"];

    //review->tweet
    public function tweet(){
        return $this->belongsTo('App\Tweet');
    }
    //review->user
    public function user(){
        return $this->belongsTo('App\User');
    }
}
