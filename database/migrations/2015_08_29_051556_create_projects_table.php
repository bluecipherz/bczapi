<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->text('description');
			$table->unsignedInteger('user_id');
			$table->unsignedInteger('client_id');
			$table->timestamps();
		});
		Schema::create('users_projects', function(Blueprint $table)
		{
			$table->unsignedInteger('user_id');
			$table->unsignedInteger('project_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('projects');
		Schema::dropIfExists('users_projects');
	}

}
