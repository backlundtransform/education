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

		$this->call('UserTableSeeder');
		
		$this->call('PivottablesTableSeeder');
		$this->call('ExercisesTableSeeder');
		$this->call('CategoriesTableSeeder');
		$this->call('QuestionsTableSeeder');
		$this->call('ExamsTableSeeder');
		$this->call('MessagesTableSeeder');
		$this->call('OptionsTableSeeder');
	}

}