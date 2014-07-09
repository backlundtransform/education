<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuestionsTable extends Migration {


	public function up()
	{
		Schema::create('questions', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('number');
			$table->string('question');
			$table->string('answer');
			$table->text('files');
			$table->integer('exercise_id');
			$table->timestamps();
		});
	}


	public function down()
	{
		Schema::drop('questions');
	}

}
