<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notifications', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('notifiable_type');
            $table->unsignedInteger('notifiable_id');
			$table->string('type', 128)->nullable();
			$table->string('subject', 128)->nullable();
			$table->text('body')->nullable();
			$table->unsignedInteger('user_id');
			$table->boolean('is_read')->default(0);
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
		Schema::drop('notifications');
	}

}
