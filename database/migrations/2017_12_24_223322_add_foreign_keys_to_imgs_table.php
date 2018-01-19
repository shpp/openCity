<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToImgsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('imgs', function(Blueprint $table)
		{
			$table->foreign('place_id')->references('id')->on('places')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('imgs', function(Blueprint $table)
		{
			$table->dropForeign('imgs_place_id_foreign');
		});
	}

}
