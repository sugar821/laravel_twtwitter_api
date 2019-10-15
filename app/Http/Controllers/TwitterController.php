<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterController extends Controller
{
    public function index(Request $request)
    {
        //ツイートを5件取得
        $result = \Twitter::get('statuses/home_timeline', array("count" => 50));
        // dd($result);
        //ViewのTwitter.blade.phpに渡す
        return view('twitter', [
            "result" => $result
        ]);
    }
}