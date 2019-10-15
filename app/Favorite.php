<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    //書き込みができるようにする
    protected $fillable = ["favorite"];
    //comment->post
    // public function post(){
    //     return $this->belongsTo('App\Post');
    //}
}
