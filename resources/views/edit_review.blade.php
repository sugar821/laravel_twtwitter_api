@extends('layouts.default')

@section('content')
    @if(isset($review))
        <form method="post" action="{{ action('ReviewController@update', $review) }}">
            {{ csrf_field() }}
            {{ method_field('patch') }}
            <label class="control-label">コメント</label>
            <p><textarea class="form-control" name="body" id="body" placeholder="body" value="{{ old('body', $review->body) }}"></textarea></p>
            @if ($errors->has('body'))
                <span class="error">{{ $errors->first('body') }}</span>
            @endif
            <p><input type="submit" class="btn btn-primary" value="更新></p>
        </form>
    @endif
@endsection
