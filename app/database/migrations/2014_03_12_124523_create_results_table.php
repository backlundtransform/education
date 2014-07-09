<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResultsTable extends Migration {

	public function up()
	{
		Schema::create('results', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('question_id');
			$table->integer('pivot_id');
			$table->integer('result');
			$table->timestamps();
		});
	}


	
	public function down()
	{
		Schema::drop('results');
	}

}
