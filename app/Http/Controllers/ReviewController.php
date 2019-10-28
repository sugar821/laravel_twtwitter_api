<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Abraham\TwitterOAuth\TwitterOAuth;
use Auth;
use App\Review;
use App\Tweet;

class ReviewController extends Controller
{
    public function review($tweet){  
            // $tweet = tweet;
        return view('review',compact('tweet'));
    }

    public function post_review(Request $request,$tweet){
        $current_user = Auth::user()->id;
        // reviewの登録
        $review = Review::create([
            'tweet_id' => $tweet,
            'user_id' => $current_user,
            'body' =>  $request->body
            ]);
        return redirect('show_review');
    }

    public function show_review(){
        $current_user = Auth::user()->id;
        $reviews = Review::where('user_id',$current_user)
        ->orderBy('created_at', 'desc')
        ->paginate(5);

        return view('show_review',[
            "reviews"=>$reviews
        ]);
    }

    public function edit($review){
        $review = Review::where('id',$review)->get();
        return view('edit_review',compact('review'));
    }

    public function update(Request $request,Reeview $review){
        dd($review);
        $review->body = $request->body;
        $review->save;
        return redirect('/');
    }
}    
