<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('interval')->default(150); //クイズ問題文の表示速度。何msごとに一文字表示するか。
            $table->unsignedBigInteger('count_down_time')->default(3); //早押しボタンを押した後のカウントダウンの秒数。単位はs
            $table->unsignedBigInteger('accuracy_num')->default(15); //historiesテーブルに存在するクイズの正誤のうち最新の何回分を正解率の算出に用いるか
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
};
