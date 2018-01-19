<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAccessibilitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('accessibilities', function(Blueprint $table)
		{
			$table->foreign('acces_title_id')->references('id')->on('accessibility_titles')->onUpdate('CASCADE')->onDelete('CASCADE');
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
		Schema::table('accessibilities', function(Blueprint $table)
		{
			$table->dropForeign('accessibilities_acces_title_id_foreign');
			$table->dropForeign('accessibilities_place_id_foreign');
		});
	}

}
