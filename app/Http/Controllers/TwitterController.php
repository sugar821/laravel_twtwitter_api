<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Abraham\TwitterOAuth\TwitterOAuth;
use Auth;
use App\User;
use App\Tweet;
use Illuminate\Support\Facades\DB;
class TwitterController extends Controller
{
    public function index(Request $request)
    {
        //ツイートを50件取得
        $result = \Twitter::get('statuses/home_timeline', array("count" => 50));
        // dd($result);
        //ViewのTwitter.blade.phpに渡す
        return view('twitter', [
            "result" => $result
        ]);
    }
    public function search(){
        return view('search');
    }

    public function show($tweet){
        $tweet = Tweet::findOrFail($tweet);
        return view('show')->with('tweet',$tweet);
    }

    public function search_word(Request $request){

        // 検索ワードの取得
        $search_word = $request->search_word;
        // 検索結果の取得
        $result = \Twitter::get('search/tweets', array('q' => $search_word, 'count' => 50, 'exclude'=> "retweets","result_type"=> "recent"));
        
        // object->arrayへの変換
        $result_to_array = json_decode(json_encode($result), true);
        // 取得データにはsearch_memetadataという不要データが含まれているのでその対応。
        // 新しく配列作成、statusesを代入する。
        $result = array();
        $result = $result_to_array["statuses"];

        // $user = Auth::user();
        // dd($user->id);

        // tweet tableのリセット
        Tweet::query()->delete();
        foreach($result as $tweet){        
            $tweets =  Tweet::create([
            'tweet_id'=>$tweet["id"],
            'tweet_user'=>$tweet["user"]["name"],
            'tweet_avater'=>$tweet["user"]["profile_image_url_https"],
            'tweet_body'=>$tweet["text"]
            ]);
        }
        $tweets = Tweet::orderBy('created_at', 'desc')->paginate(50);
        // $tweets = Tweet::all();
        // dd($tweets);
        return view('search',[
            'tweets'=>$tweets
        ]);
    }

    public function review($tweet){  

        return view('review')->with('tweet',$tweet);
    }

    public function post_review(){
        $review =  Review::create([
        'tweet_id'=>$tweet["id"],
        'tweet_user'=>$tweet["user"]["name"],
        'tweet_avater'=>$tweet["user"]["profile_image_url_https"],
        'tweet_body'=>$tweet["text"]
        ]);  
    }
}    
