<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('forums', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('description');
			$table->unsignedInteger('user_id');
			$table->unsignedInteger('project_id');
			$table->timestamps();
		});
		//~ Schema::create('users_forums', function(Blueprint $table)
		//~ {
			//~ $table->unsignedInteger('user_id');
			//~ $table->unsignedInteger('forum_id');
		//~ });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('forums');
		//~ Schema::dropIfExists('users_forums');
	}

}
