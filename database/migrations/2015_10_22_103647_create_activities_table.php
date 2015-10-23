<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activities', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('type');
			$table->unsignedInteger('subject_id');
			$table->unsignedInteger('subject_type');
			$table->integer('user_id');
			$table->unsignedInteger('project_id');
			$table->timestamps();
		});

		Schema::create('users_activities', function(Blueprint $table)
		{
			$table->unsignedInteger('user_id');
			$table->unsignedInteger('activity_id');
			
		});

		Schema::create('activities_participants', function(Blueprint $table)
		{
			
			$table->unsignedInteger('activity_id');
			$table->unsignedInteger('user_id');
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('activities');
		Schema::dropIfExists('users_activities');
		Schema::dropIfExists('activities_participants');

	}

}
