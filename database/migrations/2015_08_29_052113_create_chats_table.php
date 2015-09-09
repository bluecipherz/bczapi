<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chats', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->unsignedInteger('project_id')->default(0);
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::create('users_chats', function(Blueprint $table)
		{
			$table->unsignedInteger('user_id');
			$table->unsignedInteger('chat_id');
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
		Schema::dropIfExists('users_chats');
		Schema::dropIfExists('chats');
	}

}
