<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTmpPlacesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tmp_places', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 300);
			$table->string('kerivnik', 150);
			$table->string('city', 150);
			$table->string('street', 150);
			$table->string('number', 10);
			$table->string('tel', 150);
			$table->string('email', 150);
			$table->string('site', 150);
			$table->integer('category_id')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tmp_places');
	}

}
