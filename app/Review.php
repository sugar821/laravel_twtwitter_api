<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //書き込みができるようにする
    protected $fillable = ["body"];
}
