<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlaceCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('place_comments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('author_id')->unsigned()->nullable()->index('place_comments_author_id_foreign');
			$table->string('author_name')->nullable();
			$table->text('comment', 65535)->nullable();
			$table->smallInteger('rating')->nullable();
			$table->integer('place_id')->unsigned()->nullable()->index('place_comments_place_id_foreign');
			$table->integer('likes')->nullable();
			$table->integer('dislikes')->nullable();
			$table->boolean('hidden')->default(1);
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
		Schema::drop('place_comments');
	}

}
