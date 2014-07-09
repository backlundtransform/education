<?php

class Exam extends Eloquent {


	public static $rules = array(
		'title' => 'required',
		'file' => 'required',
		'category_id' => 'required'
	);
	
	
	
	
	
}
