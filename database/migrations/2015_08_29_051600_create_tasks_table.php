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
			$table->unsignedInteger('created_by_id');
			$table->unsignedInteger('mile_stone_id');
			$table->unsignedInteger('task_list_id');
			$table->timestamp('start_date');
			$table->timestamp('end_date');
            $table->integer('priority')->default(0);
			$table->timestamp('completed_at');
            $table->integer('progress');
            $table->integer('whpd');
			$table->timestamps();
			$table->softDeletes();
		});
        Schema::create('users_tasks', function(Blueprint $table)
        {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('task_id');
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
