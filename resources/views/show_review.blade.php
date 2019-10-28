@extends('layouts.default')

@section('content')
    @if(isset($reviews))
        @foreach ($reviews as $review)
            <div class="card mb-2 mx-5">
                <div class="card-body">
                    <div class="media">
                            <img src={{ $review->tweet->tweet_avater }} class="rounded-circle mr-4">
                            <div class="media-body">
                                <h5 class="d-inline mr-3"><strong>{{ $review->tweet->tweet_user }}</strong></h5>
                                <h6 class="d-inline text-secondary"><strong>{{ date('Y/m/d H:i', strtotime($review->tweet->updated_at)) }}</strong></h6>
                                <p class="mt-3 mb-0"><strong>{{ $review->tweet->tweet_body }}</strong></p>
                                <hr>
                                <h5 class="d-inline mr-3"><strong>{{ $review->user->name }}</strong> のコメント</h5>
                                <h6 class="mt-3 mb-0"><strong>{{ $review->body }}</strong></p>
                                <a href="{{ action('ReviewController@edit', $review->id) }}">[edit]</a>
                                |
                                <a>[delete]</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{ $reviews->links() }}
        @if(count($reviews)==0)
            <p>no result</p>
        @endif
    @endif
@endsection
