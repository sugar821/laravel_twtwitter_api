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
        return redirect('/search');
    }

    // ログアウト
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
// 参考：https://qiita.com/goombeer/items/e2ce2b256161ed5b61ba#%E8%AA%8D%E8%A8%BC%E7%94%A8%E3%81%AE%E3%82%B3%E3%83%B3%E3%83%88%E3%83%AD%E3%83%BC%E3%83%A9%E3%83%BC%E3%82%92%E4%BD%9C%E6%88%90%E3%81%99%E3%82%8B
