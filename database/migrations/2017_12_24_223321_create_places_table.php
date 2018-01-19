<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlacesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('places', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 500)->nullable();
			$table->integer('address_id')->unsigned()->nullable();
			$table->integer('category_id')->unsigned()->nullable()->index('places_category_id_foreign');
			$table->string('comment')->nullable();
			$table->timestamps();
			$table->string('city')->nullable();
			$table->string('street')->nullable();
			$table->string('number')->nullable();
			$table->string('geo_place_id')->nullable();
			$table->decimal('map_lat', 18, 14)->nullable();
			$table->decimal('map_lng', 18, 14)->nullable();
			$table->string('comment_adr')->nullable();
			$table->string('short_name')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('places');
	}

}
