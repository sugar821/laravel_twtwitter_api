<?php

Route::get('/', 'TwitterController@index');
Route::get('/search', 'TwitterController@search');
Route::post('/search', 'TwitterController@search_word');
// ログインURL
Route::get('auth/twitter', 'Auth\TwitterController@redirectToProvider');
// コールバックURL
Route::get('auth/twitter/callback', 'Auth\TwitterController@handleProviderCallback');
// ログアウトURL
Route::get('auth/twitter/logout', 'Auth\TwitterController@logout');
// tweet登録
Route::post('/regist_tweet','TwitterController@regist_tweet');
// review作成
Route::get('review/{tweet}','TwitterController@review');
Route::post('review/{tweet}','TwitterController@post_review');
Route::get('/show_review', 'TwitterController@show_review');
