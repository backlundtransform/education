<?php

class Question extends Eloquent {
	
 public function exercise()
    {
        return $this->belongsTo('Exercise');
    }
	
	 public function option()
    {
        return $this->hasMany('Option');
    }
	
 public static function createquestion($items, $filename)
    {
    	    $question = new Question;
			if (Input::has('question'))
            $question->question  = $items['question'];
			if (Input::has('answer'))
            $question->answer =  strtolower($items['answer']);
			if (Input::has('file'))
            $question->files = $items['file'];
		    if (Input::has('exercise'))
			$question->exercise_id =  $items['exercise'];
			$question->number = count(Question::where('exercise_id','=',$items['exercise'])->get())+1;
            $question->save();
			
			 $options=Option::where('question_id', '=', '0')->get();
			foreach ($options as $key => $option) {
				
				$option->question_id=$question->id;
				$option->update();
				
			}
			return $question;

    }
}
