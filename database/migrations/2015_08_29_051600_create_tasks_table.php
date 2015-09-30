<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tasks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->text('description');
			$table->unsignedInteger('project_id');
			$table->unsignedInteger('milestone_id');
			$table->unsignedInteger('tasklist_id');
			$table->timestamp('start_date');
			$table->integer('duration');
            $table->integer('priority');
			$table->timestamp('completed_at');
            $table->integer('percentage_completed');
            $table->integer('whpd');
			$table->timestamps();
			$table->softDeletes();
		});
        Schema::create('users_tasks', function(Blueprint $table)
        {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('task_id');
			$table->string('type');
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
		Schema::dropIfExists('users_tasks');
		Schema::dropIfExists('tasks');
	}

}
