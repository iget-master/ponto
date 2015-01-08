<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimetablesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('timetables', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('user_id')->unique();
			$table->date('date')->unique();
			$table->time('time_in')->nullable();
			$table->time('time_out')->nullable();
			$table->string('justification','255')->nullable();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('timetables');
	}

}
