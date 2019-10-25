@extends('layouts.default')

@section('content')
    @foreach ($result as $tweet)
        <div class="card mb-2 mx-5">
            <div class="card-body">
                <div class="media">
                    <img src={{ $tweet->user->profile_image_url_https }} class="rounded-circle mr-4">
                    <div class="media-body">
                        <h5 class="d-inline mr-3"><strong>{{ $tweet->user->name }}</strong></h5>
                        <h6 class="d-inline text-secondary">{{ date('Y/m/d', strtotime($tweet->created_at)) }}</h6>
                        <p class="mt-3 mb-0">{{ $tweet->text }}</p>
                        <form method="post" action="{{ url('/regist_tweet') }}">
                        {{ csrf_field() }}
                        <p><input type="hidden" name="tweet_id" value={{$tweet->id}}></p>
                        <p><input type="hidden" name="name" value={{$tweet->user->name}}></p>
                        <p><input type="hidden" name="text" value={{$tweet->text}}></p>
                        <p><input type="hidden" name="avater" value={{$tweet->user->profile_image_url_https}}></p>
                        <p><input type="submit" value="vote review"></p>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white border-top-0">
                <div class="d-flex flex-row justify-content-end">
                    <div class="mr-5"><a href="{{ action('TwitterController@review', $tweet->id) }}"<i class="far fa-comment text-secondary"></i></a></div>
                    <div class="mr-5"><i class="far fa-heart text-secondary"></i></div>
                    
                    
                </div>
            </div>
        </div>
    @endforeach
@endsection

  