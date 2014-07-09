<?php

class Result extends Eloquent {
	protected $guarded = array();
	public static $rules = array();
	
	
	 public function pivottable()
    {
        return $this->belongsTo('Pivottable');
    }
	
	
	 public static function resultsave($id, $boolean)
    {
				
			$question = Question::find($id);
			$user = Auth::user();
					
			$pivots=$user->exercise()->get();
			
		    foreach ($pivots as $pivot){
		    		
		    	if($pivot->pivot->exercise_id==$question->exercise->id){
		    		$result=Result::where('pivot_id', '=', $pivot->pivot->id)->where('question_id', '=', $question->id)->get();
				
				 if(count($result)==0){
						$new_result = new Result;
						$new_result->pivot_id=$pivot->pivot->id;
						$new_result->question_id=$question->id;
						$new_result->result=$boolean;
						$new_result->save();
					}elseif(count($result)==1 && $boolean==1){
							
						$result->first();
						$result->first()->result=1;
						$result->first()->update();
					}
				  };
				}
          
}
}