<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPlaceCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('place_comments', function(Blueprint $table)
		{
			$table->foreign('author_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('place_id')->references('id')->on('places')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('place_comments', function(Blueprint $table)
		{
			$table->dropForeign('place_comments_author_id_foreign');
			$table->dropForeign('place_comments_place_id_foreign');
		});
	}

}
