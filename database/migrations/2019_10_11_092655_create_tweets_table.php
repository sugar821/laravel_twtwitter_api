<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTweetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweets', function (Blueprint $table) {
            $table->numeric('tweet_id')->unsigned()->unique();
            $table->text('tweet_avater');
            $table->text('tweet_user');
            $table->string('tweet_body');
            $table->timestamps();
        });
    }

    // public function up()
    // {
    //     switch ($_SERVER['SERVER_NAME'] ?? '127.0.0.1') {
    //     case '127.0.0.1':
    //         Schema::create('tweets', function (Blueprint $table) {
    //         $table->integer('tweet_id')->unsigned()->unique();
    //         $table->text('tweet_avater');
    //         $table->text('tweet_user');
    //         $table->string('tweet_body');
    //         $table->timestamps();
    //         });
    //         break;
    //     default:
    //         Schema::create('tweets', function (Blueprint $table) {
    //         $table->bigint('tweet_id')->unsigned()->unique();
    //         $table->text('tweet_avater');
    //         $table->text('tweet_user');
    //         $table->string('tweet_body');
    //         $table->timestamps();
    //     });
    //     }
    // }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tweets');
    }
}
