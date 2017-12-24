<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAccessibilitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accessibilities', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('place_id')->unsigned()->nullable()->index('accessibilities_place_id_foreign');
			$table->integer('acces_title_id')->unsigned()->nullable()->index('accessibilities_acces_title_id_foreign');
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
		Schema::drop('accessibilities');
	}

}
