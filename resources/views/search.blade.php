@extends('layouts.default')

@section('content')
  
    <h2>search</h2>
    <form method="post" action="{{ action('TwitterController@search_word') }}">
        {{ csrf_field() }}
        <input type="text" name="search_word" placeholder="enter hashtag!">
        <input type="submit" value="search">
    </form>
  {{-- 変数の存在確認、ないとエラーになる　--}}  
  @if(isset($tweets))
    @foreach($tweets as $tweet)
    <div class="card mb-2 mx-5">
            <div class="card-body">
                <div class="media">
                    <img src={{$tweet->tweet_avater}} class="rounded-circle mr-4">
                    <div class="media-body">
                      <p>{{$tweet->tweet_user}}</p>
                      <p>{{date('Y/m/d H:i', strtotime($tweet->created_at))}}</p>
                      <p>{!! nl2br(e($tweet->tweet_body)) !!}</p>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white border-top-0">
                <div class="d-flex flex-row justify-content-end">
                    <div class="mr-5"><a href="{{ action('TwitterController@show', $tweet) }}"<i class="far fa-comment text-secondary"></i></a></div>
                    <div class="mr-5"><i class="fas fa-retweet text-secondary"></i></div>
                    <div class="mr-5"><i class="far fa-heart text-secondary"></i></div>
                </div>
            </div>
        </div>  
    @endforeach
    {{-- $tweets->links() --}}
    {{-- 検索結果が0の場合、メッセージ出力する　--}}  
    @if(count($tweets)==0)
      <p>no result</p>
    @endif
  @endif    
@endsection