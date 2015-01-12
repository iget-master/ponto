<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		DB::table('users')->delete();
		$statement = "ALTER TABLE `users` AUTO_INCREMENT = 1;";

        DB::unprepared($statement);

		User::create([
				'name'=>'Admin',
				'surname'=>'Teste',
				'email'=>'test@domain.com',
				'password'=>Hash::make('12345678'),
				'level'=>'2'
			]);
		User::create([
				'name'=>'Dumb',
				'surname'=>'One',
				'email'=>'dumb1@domain.com',
				'password'=>Hash::make('12345678'),
				'level'=>'1'
			]);
		User::create([
				'name'=>'Dumb',
				'surname'=>'Two',
				'email'=>'dumb2@domain.com',
				'password'=>Hash::make('12345678'),
				'level'=>'1'
			]);
		User::create([
				'name'=>'Dumb',
				'surname'=>'Three',
				'email'=>'dumb3@domain.com',
				'password'=>Hash::make('12345678'),
				'level'=>'1'
			]);

		// $this->call('UserTableSeeder');
	}

}
