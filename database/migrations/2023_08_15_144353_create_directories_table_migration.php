<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectoriesTableMigration extends Migration
{
    public function up()
    {
        //biginteger型でないとquizzesテーブルとのリレーションがうまくできないので書き換えた
        Schema::create('directories', function (Blueprint $table) {
            // $table->increments('id');
            $table->id();
            $table->foreignId('user_id')->constrained();
            // $table->integer('parent_id')->unsigned()->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('name', 30);
            // $table->integer('position', false, true);
            $table->unsignedBigInteger('position');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('parent_id')
                ->references('id')
                ->on('directories')
                ->onDelete('set null');

        });

        Schema::create('directory_closure', function (Blueprint $table) {
            // $table->increments('closure_id');

            // $table->integer('ancestor', false, true);
            // $table->integer('descendant', false, true);
            // $table->integer('depth', false, true);
            
            $table->id('closure_id');
            
            $table->unsignedBigInteger('ancestor');
            $table->unsignedBigInteger('descendant');
            $table->unsignedBigInteger('depth');

            $table->foreign('ancestor')
                ->references('id')
                ->on('directories')
                ->onDelete('cascade');

            $table->foreign('descendant')
                ->references('id')
                ->on('directories')
                ->onDelete('cascade');

        });
    }

    public function down()
    {
        Schema::dropIfExists('directory_closure');
        Schema::dropIfExists('directories');
    }
}
