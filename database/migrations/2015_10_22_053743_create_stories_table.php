<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->text('description');
			$table->tinyInteger('priority')->default(0);
			$table->integer('work_hours');
			$table->unsignedInteger('sprint_id');
			$table->unsignedInteger('project_id');
			$table->unsignedInteger('user_id');
			$table->unsignedInteger('predecessor_id');
			$table->timestamps();
		});
		Schema::create('stories_users', function(Blueprint $table)
		{
			$table->unsignedInteger('user_id');
			$table->unsignedInteger('story_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('stories');
		Schema::dropIfExists('stories_users');
	}

}
