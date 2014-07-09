<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($tabellen){
			$tabellen->increments('id');
			$tabellen->string('username');
			$tabellen->string('password');
			$tabellen->string('fornamn');
			$tabellen->string('efternamn');
			$tabellen->boolean('aktiverad');
			$tabellen->enum('roles', array('Admin', 'User'))->default('User');
			$tabellen->string('email');
			$tabellen->integer('category_id')->default('1');
			
			$tabellen->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
