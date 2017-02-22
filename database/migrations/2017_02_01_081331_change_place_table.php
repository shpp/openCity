<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Place;
use App\Address;

class ChangePlaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('places', function($table){
            $table->string('city')->nullable()->default(null);
            $table->string('street')->nullable()->default(null);
            $table->string('number')->nullable()->default(null);
            $table->string('geo_place_id')->nullable()->default(null);
            $table->decimal('map_lat', 18, 14)->nullable()->default(null);
            $table->decimal('map_lng', 18, 14)->nullable()->default(null);
            $table->string('comment_adr')->nullable()->default(null);
        });

        $places = Place::all();
        foreach ($places as $place) {
            $address = Address::find($place->address_id);
            $place->city = $address->city;
            $place->street = $address->street;
            $place->number = $address->number;
            $place->geo_place_id = $address->geo_place_id;
            $place->map_lat = $address->map_lat;
            $place->map_lng = $address->map_lng;
            $place->comment_adr = $address->comment;
            $place->save();
        }
        Schema::dropIfExists('addresses');


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('places', function($table){
            $table->dropColumn(['city','street','number','geo_place_id','map_lat','map_lng','comment_adr']);
        });
    }
}
