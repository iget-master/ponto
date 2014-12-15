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

		User::create([
				'name'=>'Admin',
				'surname'=>'Teste',
				'email'=>'test@domain.com',
				'password'=>Hash::make('12345678')
			]);

		// $this->call('UserTableSeeder');
	}

}
