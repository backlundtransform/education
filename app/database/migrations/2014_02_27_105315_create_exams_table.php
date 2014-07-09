<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExamsTable extends Migration {

	
	public function up()
	{
		Schema::create('exams', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->string('files');
			$table->integer('category_id')->default('1');
			$table->timestamps();
		});
	}


	
	public function down()
	{
		Schema::drop('exams');
	}

}
