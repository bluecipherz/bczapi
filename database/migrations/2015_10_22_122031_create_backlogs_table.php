<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBacklogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('backlogs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->boolean('release');
			$table->unsignedInteger('project_id');
			$table->unsignedInteger('user_id');
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
		Schema::drop('backlogs');
	}

}
