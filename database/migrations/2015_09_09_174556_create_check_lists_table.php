<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckListsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('check_lists', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name');
            $table->unsignedInteger('task_id');
            $table->unsignedInteger('user_id');
			$table->timestamps();
		});
        Schema::create('check_marks', function(Blueprint $table)
        {
            $table->unsignedInteger('check_list_id');
            $table->string('name');
            $table->unsignedInteger('user_id');
            $table->boolean('checked');
            $table->unsignedInteger('checked_user_id');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('check_marks');
		Schema::dropIfExists('check_lists');
	}

}
