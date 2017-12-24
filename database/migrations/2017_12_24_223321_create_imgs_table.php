<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImgsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('imgs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('place_id')->unsigned()->nullable()->index('imgs_place_id_foreign');
			$table->string('path')->nullable();
			$table->string('comment')->nullable();
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
		Schema::drop('imgs');
	}

}
