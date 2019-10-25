<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Abraham\TwitterOAuth\TwitterOAuth;
use Auth;
use App\Review;
use App\Tweet;

class TwitterController extends Controller
{
    public function index(Request $request)
    {
        //ツイートを50件取得
        $result = \Twitter::get('statuses/home_timeline', array("count" => 50));
        // dd($result);
        return view('twitter', [
            "result" => $result
        ]);
    }
    public function search(){
        return view('search');
    }

    public function search_word(Request $request)
    {
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
        
        // dd($result);
        return view('search', [
            "result" => $result
        ]);
    }

    public function regist_tweet(Request $request){
        $tweet = $request->tweet_id;
        $name = $request->name;
        $text = $request->text;
        $avater = $request->avater;

        // tweetの存在確認後、tweetを登録
        $registered = Tweet::where('tweet_id',$tweet)->first();
        if (!$registered){
                $tweets =  Tweet::create([
                    'tweet_id'=>$tweet,
                    'tweet_user'=>$name,
                    'tweet_avater'=>$avater,
                    'tweet_body'=>$text
                    ]);
        }
        return view('review',compact('tweet'));
    }

    public function review($tweet){  
            // $tweet = tweet;
        return view('review',compact('tweet'));
    }

    public function post_review(Request $request,$tweet){
        $current_user = Auth::user()->id;
        
        // reviewの登録
        $review = Review::create([
            'tweet_id' => $tweet,
            'user_id' => $current_user,
            'body' =>  $request->body
            ]);
        return redirect('show_review');
    }

    public function show_review(){
        $current_user = Auth::user()->id;
        $reviews = Review::where('user_id',$current_user)
        ->orderBy('created_at', 'desc')
        ->paginate(5);

        return view('show_review',[
            "reviews"=>$reviews
        ]);
    }
}    
