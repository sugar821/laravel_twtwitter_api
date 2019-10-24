@extends('layouts.default')

@section('content')
    @if(isset($reviews))
        @foreach ($reviews as $review)
            <div class="card mb-2 mx-5">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                            <h6 class="d-inline text-secondary"><strong>{{ date('Y/m/d H:i', strtotime($review->updated_at)) }}</strong></h6>
                            <h5 class="d-inline mr-3"><strong>{{ $review->tweet_id }}</strong></h5>
                            <p class="mt-3 mb-0"><strong>{{ $review->body }}</strong></p>
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
