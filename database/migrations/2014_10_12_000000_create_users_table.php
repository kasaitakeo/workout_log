<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 新しいデータベーステーブルを作成するには、Schemaファサードのcreateメソッドを使用
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            // unique()重複した値を格納できなくなる
            // comment('アカウント名') カラムにコメント追加
            $table->string('screen_name')->unique()->null()->comment('アカウント名');
            $table->string('name')->null()->comment('ユーザ名');
            $table->string('profile_image')->nullable()->comment('プロフィール画像');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
