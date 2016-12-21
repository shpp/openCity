<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('city')->nullable()->default(null);
            $table->string('street')->nullable()->default(null);
            $table->string('number')->nullable()->default(null);
            $table->string('geo_place_id')->nullable()->default(null);
            $table->decimal('map_lat', 18, 14)->nullable()->default(null);
            $table->decimal('map_lng', 18, 14)->nullable()->default(null);
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
        Schema::dropIfExists('addresses');
    }
}
