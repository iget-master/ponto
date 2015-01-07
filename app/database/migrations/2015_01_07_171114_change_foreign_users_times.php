<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeForeignUsersTimes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users_times', function(Blueprint $table)
		{
			$table->dropForeign('users_times_user_id_foreign');
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
		Schema::table('users_times', function(Blueprint $table)
		{
			$table->dropForeign('users_times_user_id_foreign');
			$table->foreign('user_id')->references('id')->on('users');
		});
	}

}
