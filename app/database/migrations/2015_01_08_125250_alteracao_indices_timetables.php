<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlteracaoIndicesTimetables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('timetables', function(Blueprint $table)
		{
			$table->dropForeign('timetables_user_id_foreign');
			$table->dropUnique('timetables_user_id_unique');
			$table->dropUnique('timetables_date_unique');
			$table->unique(['user_id', 'date']);
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('timetables', function(Blueprint $table)
		{
			$table->dropForeign('timetables_user_id_foreign');
			$table->dropUnique('timetables_user_id_date_unique');
			$table->unique('user_id');
			$table->unique('date');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

		});
	}

}
