<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberActionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('member_actions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('action');
			$table->string('memberable_type');
			$table->unsignedInteger('memberable_id');
			$table->unsignedInteger('user_id');
			$table->unsignedInteger('admin_id');
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
		Schema::drop('member_actions');
	}

}
