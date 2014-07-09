<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePivottablesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pivottables', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('exercise_id');
			$table->integer('questionlevel');
			$table->boolean('done');
			$table->timestamps();
		});
	}


	
	public function down()
	{
		Schema::drop('pivottables');
	}

}
