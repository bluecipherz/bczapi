<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckListColumnsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('check_list_columns', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string("name");
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('check_list_id');
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
		Schema::dropIfExists('check_list_columns');
	}

}
