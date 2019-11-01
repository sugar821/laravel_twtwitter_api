<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
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
        $result = \Twitter::get('statuses/home_timeline', array("count" => 50, 'exclude'=> "retweets","result_type"=> "recent"));
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

        // 検索ワードが空でないかをチェック、空ならメッセージを出力する
        if ($search_word == null){
            $msg="検索ワードを入力してください";
            return view('/search',[
                    "msg" => $msg
            ]);
        }
        // 検索結果の取得、RTを除く
        $result = \Twitter::get('search/tweets', array('q' => $search_word, 'count' => 50, 'exclude'=> "retweets","result_type"=> "recent"));
        
        // object->arrayへの変換
        $result_to_array = json_decode(json_encode($result), true);
        // 取得データにはsearch_memetadataという不要データが含まれているのでその対応。
        // 新しく配列作成、statusesを代入する。
        $result = array();
        $result = $result_to_array["statuses"];
        // 検索結果が0でないかをチェック、0ならメッセージを出力する
        if (count($result)==0){
            $msg="検索結果がありませんでした";
            return view('/search',[
                    "msg" => $msg
            ]);
        }

        // ---------------------------------test---------------------------------
        // paginate実装できてない　参考qiita
        // https://qiita.com/wallkickers/items/35d13a62e0d53ce05732#_reference-f177618590fa5e32dfed
        // $result = array_slice($result,0,10);
        
        $result = new LengthAwarePaginator(
            $result = array_slice($result,0,10),
            count($result),
            10,
            $request->page,
            array('path' => $request->url())
        );

        // dump($result);
        // dd($request->page);

        // ---------------------------------test---------------------------------
        return view('search', [
            "result" => $result
        ]);
    }

    public function regist_tweet(Request $request){
        $tweet = $request->tweet_id;
        $name = $request->name;
        $text = $request->text;
        $avater = $request->avater;
        // dd($request->text);
        // tweetの存在確認、未登録ならtweetを登録
        $registered = Tweet::where('tweet_id',$tweet)->first();
        if (!$registered){
                $tweets =  Tweet::create([
                    'tweet_id'=>$tweet,
                    'tweet_user'=>$name,
                    'tweet_avater'=>$avater,
                    'tweet_body'=>$text
                    ]);
        }

        return redirect()->route('review',['tweet'=>$tweet]);
        
    }
}    