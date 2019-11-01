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
                                <h5 class="d-inline mr-3"><strong>{{ $review->user->name }}</strong> 's comment</h5>
                                <h6 class="mt-3 mb-0"><strong>{{ $review->body }}</strong></p>
                                <a href="{{ action('ReviewController@edit', $review->id) }}">[edit]</a>
                                <a href="#" class="del" data-id="{{$review->id}}">[del]</a>
                                <form method = "post" action ="{{ action('ReviewController@destroy', $review->id) }}" id="form_{{$review->id}}">    
                                {{ method_field('delete') }}
                                {{ csrf_field() }}
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="d-flex flex-row justify-content-end">
            {{ $reviews->links() }}
        </div>
        @if(count($reviews)==0)
            <p>no review yet</p>
        @endif
    @endif
<script src="/js/main.js"></script>
@endsection
