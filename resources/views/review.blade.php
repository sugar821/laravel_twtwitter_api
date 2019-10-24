@extends('layouts.default')

@section('content')
post
<form method="post" action="{{ action('TwitterController@post_review', $tweet) }}">
    {{ csrf_field() }}
    <p><textarea name="body" id="body" placeholder="body"></textarea></p>
    <p><input type="submit" value="review"></p>
  </form>
@endsection