<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckMarksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('check_marks', function(Blueprint $table)
		{
			$table->increments('id');
            $table->unsignedInteger('check_list_id');
            $table->unsignedInteger('check_list_row_id');
            $table->unsignedInteger('check_list_column_id');
            $table->string('name');
            $table->unsignedInteger('user_id');
            $table->boolean('checked');
            $table->unsignedInteger('checked_user_id');
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
		Schema::dropIfExists('check_marks');
	}

}
