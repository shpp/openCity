<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToParameterTitlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('parameter_titles', function(Blueprint $table)
		{
			$table->foreign('parameter_type_id')->references('id')->on('parameter_types')->onUpdate('CASCADE')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('parameter_titles', function(Blueprint $table)
		{
			$table->dropForeign('parameter_titles_parameter_type_id_foreign');
		});
	}

}
