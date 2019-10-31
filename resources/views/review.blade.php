@extends('layouts.default')

@section('content')

<form method="post" action="{{ action('ReviewController@post_review', $tweet) }}">
    {{ csrf_field() }}
    <label class="control-label">コメント</label>
    <p><input type="textarea" class="form-control" name="body" id="body" placeholder="enter comment"></textarea></p>
    @if ($errors->has('body'))
        <span class="error">{{ $errors->first('body') }}</span>
    @endif
    <p><input type="submit" class="btn btn-primary" value="送信"></p>
</form>
<a href="{{ action('TwitterController@search_word') }}">戻る</a>
@endsection