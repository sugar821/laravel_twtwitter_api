@extends('layouts.default')

@section('content')
    <h2>search</h2>
    <form method="post" action="{{ action('TwitterController@search_word') }}">
        {{ csrf_field() }}
        <input type="text" name="search_word" placeholder="enter hashtag!">
        <input type="submit" value="search">
    </form>
  {{-- 変数の存在確認、ないとエラーになる　--}}  
  @if(isset($result))
    @foreach($result as $tweet)
    <div class="card mb-2 mx-5">
      <div class="card-body">
          <div class="media">
            <img src={{ $tweet["user"]["profile_image_url_https"] }} class="rounded-circle mr-4">
            <div class="media-body">
              <h5 class="d-inline mr-3"><strong>{{ $tweet["user"]["name"] }}</strong></h5>
              <h6 class="d-inline text-secondary">{{ date('Y/m/d H:i', strtotime($tweet["created_at"])) }}</h6>
              <p class="mt-3 mb-0">{!! nl2br(e($tweet["text"])) !!}</p>
              <form method="post" action="{{ url('/regist_tweet') }}">
              {{ csrf_field() }}
              <p><input type="hidden" name="tweet_id" value={{$tweet['id']}}></p>
              <p><input type="hidden" name="name" value={{ $tweet['user']['name'] }}></p>
              <p><input type="hidden" name="text" value={{ $tweet['text'] }}></p>
              <p><input type="hidden" name="avater" value={{ $tweet["user"]["profile_image_url_https"] }}></p>
              <p><input type="submit" value="コメントする"></p>
              </form>
            </div>
          </div>
      </div>
    </div>  
    @endforeach
    {{-- $tweets->links() --}}
    {{-- 検索結果が0の場合、メッセージ出力する　--}}  
    @if(count($result)==0)
      <p>no result</p>
    @endif
  @endif    
@endsection