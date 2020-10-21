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
            $table->increments('id');            
            // unsignedInteger符号なしINTカラム
            $table->unsignedInteger('user_id')->comment('ユーザID');
            $table->string('text')->comment('本文');
            // ソフトデリートのためにNULL値可能で有効（全体）桁数指定のdeleted_at TIMESTAMPカラム追加
            $table->softDeletes();
            $table->timestamps();

            // インデックスの追加
            $table->index('id');
            $table->index('user_id');
            $table->index('text');

            // 外部キー制約 Usersテーブルと外部キー接続を宣言
            // CASCADE 親テーブルに対して更新を行うと子テーブルで同じ値を持つカラムの値も合わせて更新される
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }    

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
