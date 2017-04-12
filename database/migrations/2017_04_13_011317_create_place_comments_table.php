<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaceCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('place_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id')->unsigned()->nullable()->default(null);
            $table->foreign('author_id')->references('id')->on('users');
            $table->string('author_name')->nullable();
            $table->text('comment')->nullable();
            $table->smallInteger('rating')->nullable();
            $table->integer('place_id')->unsigned()->nullable()->default(null);
            $table->foreign('place_id')->references('id')->on('places');
            $table->integer('likes')->nullable();
            $table->integer('dislikes')->nullable();
            $table->boolean('hidden')->default(1);
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
        Schema::drop('place_comments');
    }
}
