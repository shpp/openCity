<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('email')->nullable()->unique();
			$table->string('password')->nullable();
			$table->string('remember_token', 100)->nullable();
			$table->timestamps();
			$table->string('provider')->default('registration');
			$table->string('provider_id')->nullable()->unique();
			$table->boolean('banned')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
