<?php

class Option extends Eloquent {
	protected $guarded = array();

	public static $rules = array();
	
	 public function question()
    {
        return $this->belongsTo('question');
    }
	
	
	public static function optioncreate($items){
	
	$option = new Option;
            $option->option = strtolower($items['option']);
          	$option->question_id = 0;
			$option->save();
			
}
}