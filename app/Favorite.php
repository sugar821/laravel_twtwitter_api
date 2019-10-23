<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    //書き込みができるようにする
    protected $fillable = ["favorite"];
    
    //favorite->tweet
    public function tweet(){
        return $this->belongsTo('App\Tweet');
    }
    //favorite->user
    public function user(){
        return $this->belongsTo('App\User');
    }
}
