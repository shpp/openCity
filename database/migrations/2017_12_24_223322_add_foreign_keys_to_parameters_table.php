<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToParametersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('parameters', function(Blueprint $table)
		{
			$table->foreign('param_title_id')->references('id')->on('parameter_titles')->onUpdate('CASCADE')->onDelete('CASCADE');
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
		Schema::table('parameters', function(Blueprint $table)
		{
			$table->dropForeign('parameters_param_title_id_foreign');
			$table->dropForeign('parameters_place_id_foreign');
		});
	}

}
