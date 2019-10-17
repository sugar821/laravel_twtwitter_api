<?php

namespace App\Http\Controllers\Auth;
use Auth;
use App\User;
use App\Http\Controllers\Controller;
use Socialite;

class TwitterController extends Controller
{

    // ログイン
    public function redirectToProvider(){
        return Socialite::driver('twitter')->redirect();
    }

    // コールバック
    public function handleProviderCallback(){
        try {
            $twitterUser = Socialite::driver('twitter')->user();
        } catch (Exception $e) {
            return redirect('auth/twitter');
        }
        // dd($twitterUser);
        // 各自ログイン処理
        // 例
        $user = User::where('twitter_id', $twitterUser->id)->first();
        // dd($user);
        if (!$user) {
            $user = User::create([
                'name' => $twitterUser->name,
                'twitter_id' => $twitterUser->id,
                'avatar'=>$twitterUser->avatar_original
          ]);
        }
        Auth::login($user);
        return redirect('/');
    }

    // ログアウト
    public function logout(Request $request)
    {
        // 各自ログアウト処理
        // 例
        // Auth::logout();
        return redirect('/');
    }
}
