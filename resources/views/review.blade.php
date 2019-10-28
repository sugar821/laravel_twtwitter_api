@extends('layouts.default')

@section('content')

<form method="post" action="{{ action('ReviewController@post_review', $tweet) }}">
    {{ csrf_field() }}
    <label class="control-label">コメント</label>
    <p><textarea class="form-control" name="body" id="body" placeholder="body"></textarea></p>
    <p><input type="submit" class="btn btn-primary" value="送信"></p>
</form>
@endsection