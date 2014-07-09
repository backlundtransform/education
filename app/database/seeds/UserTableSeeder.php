<?php

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(array(
        	'username' => 'Goran',
            'roles' => 'Admin',
        	'password' => Hash::make('12345'),
        	'category_id' => '0',
        	'email' => 'foo@bar.com',
        	'aktiverad' => true
        ));

      
        
    }
}