<?php
// php artisan make:model Models/ContactForm -mコマンドでModelと同時作成
// php artisan migrateでこのファイルを実行しデータベースに保存

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_forms', function (Blueprint $table) {
            // 元々ついてる
            $table->bigIncrements('id');
            // 氏名、メールアドレス、URL、性別、年齢、お問い合わせ内容を後から追加
            $table->string('your_name', 20);
            $table->string('email', 255);
            // URLはNULLでもいいのでカラム修飾子使う->nullable($value = true)メソッドチェーン
            $table->longText('url')->nullable($value = true);
            // ->unsigned()整数カラムを符号なしに設定(MySQLのみ)
            $table->boolean('gender')->unsigned();
            $table->tinyInteger('age');
            $table->string('contact', 200);
            // 元々ついてる
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
        Schema::dropIfExists('contact_forms');
    }
}
