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
// review作成
Route::get('/review/{tweet}','TwitterController@review');
Route::post('review','TwitterController@post_review');
