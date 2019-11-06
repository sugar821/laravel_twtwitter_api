<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class TwitterTest extends TestCase
{
    // テストユーザでログイン後、リダイレクトされているか
    public function testUserLoginByEmail()
    {
        $user = \Faker\Factory::create();\Faker\Factory::create();

        $response = $this->post('login',[
            'E-Mail Address'=>$user->email,
            'Password'=>$user->password
        ]);
        $response->assertRedirect('/');
        
    }
    
    public function testTwitterSearch()
    {
        $user = \Faker\Factory::create();\Faker\Factory::create();

        $response = $this->post('/search',[
            'search_word'=>"testkeyword"
        ]);

        $this->expectOutputString("testkeyword");
    }

}
