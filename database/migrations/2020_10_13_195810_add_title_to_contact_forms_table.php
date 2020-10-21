<?php

// php artisan make:migration add_title_to_contact_forms_table --table=contact_forms
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleToContactFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 既存のテーブルに追加の際はSchema::tableとなる
        Schema::table('contact_forms', function (Blueprint $table) {
            // カラム修飾子->after('your_name')を使用するとyour_nameの後に追加される
            $table->string('title', 50)->after('your_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // downにdropColumn書いた状態でrollbackコマンドを行うと処理が戻る
    public function down()
    {
        Schema::table('contact_forms', function (Blueprint $table) {
            //
        });
    }
}
