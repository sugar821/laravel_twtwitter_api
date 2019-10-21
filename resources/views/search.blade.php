@extends('layouts.default')

@section('content')
  
    <h2>search</h2>
    <form method="post" action="{{ action('TwitterController@search_word') }}">
        {{ csrf_field() }}
        <input type="text" name="search_word" placeholder="enter hashtag!">
        <input type="submit" value="search">
    </form>
  @if(isset($result))
    @foreach($result as $tweet)
        <div class="card mb-2 mx-5">
            <div class="card-body">
                <div class="media">
                    <img src={{ $tweet["user"]["profile_image_url_https"] }} class="rounded-circle mr-4">
                    <div class="media-body">
                      <p>{{ date('Y/m/d', strtotime($tweet["created_at"])) }}</p>
                      <p>{{ $tweet["user"]["name"] }}</p>
                      <p>{{ $tweet["text"] }}</p>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white border-top-0">
                <div class="d-flex flex-row justify-content-end">
                    <div class="mr-5"><i class="far fa-comment text-secondary"></i></div>
                    <div class="mr-5"><i class="fas fa-retweet text-secondary"></i></div>
                    <div class="mr-5"><i class="far fa-heart text-secondary"></i></div>
                </div>
            </div>
        </div>  
    @endforeach
  @else
    <p>no result</p>
  @endif
    
@endsection