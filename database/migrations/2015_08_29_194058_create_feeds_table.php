<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('feeds', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('type');
            $table->unsignedInteger('origin_id');
            $table->unsignedInteger('subject_id');
            $table->string('subject_type');
            $table->unsignedInteger('context_id'); // only for comment, status & project
            $table->string('context_type');
			$table->timestamps();
		});
		Schema::create('feeds_users', function(Blueprint $table) {
			$table->unsignedInteger('user_id');
			$table->unsignedInteger('feed_id');
			$table->boolean('read');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('feeds_users');
		Schema::dropIfExists('feeds');
	}

}
