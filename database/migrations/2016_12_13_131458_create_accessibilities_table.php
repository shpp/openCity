<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessibilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accessibilities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('place_id')->unsigned()->nullable()->default(null);
            $table->integer('acces_title_id')->unsigned()->nullable()->default(null);
            $table->string('comment')->nullable()->default(null);
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
        Schema::dropIfExists('accessibilities');
    }
}
