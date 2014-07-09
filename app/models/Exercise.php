<?php

class Exercise extends Eloquent {
	 public function category()
    {
        return $this->belongsTo('Category');
    }
	
	 public function question()
    {
        return $this->hasMany('Question');
    }
	public function user()
    {
      return $this->belongsToMany('User', 'Pivottables', 'exercise_id', 'user_id')
      		->withPivot('id', 'questionlevel','done')
		->withTimestamps();
    }
	
public static function exercisecreate($items){
	
			 $exercise = new Exercise;
             $exercise->title = $items['title'];
          	 $exercise->category_id = $items['category_id'];
			 $exercise->view = 'a_1';
			 $exercise->description = 'Lägg till Beskrivning';
             $exercise->save();
			
			$users = User::all();
			
			$questions=1;
			foreach ($users as $user) 
			{
				$exercise->user()->attach(1, array('exercise_id' => $exercise->id, 'user_id' => $user->id, 'questionlevel' => $questions
				));
				
			}
			
			
	
}


public static function errorarray($exercise_id){
	 		$user = Auth::user();
			$array = array();
			$pivots = $user->exercise()->get();
			
			
			
		   foreach ($pivots as $pivot){
		    	
				
				if($pivot->pivot->exercise_id==$exercise_id){
					  $results= Pivottable::find($pivot->pivot->id)->result;
					
					  foreach ($results as $result){
					  	
						if($result->result==1)
						{
					   		array_push($array, "right");
						}
						elseif($result->result==0)
						{
							array_push($array, "wrong");
							
						}
						}
					}
		   }
					
					$foobar=count(Exercise::Find($exercise_id)->question)-count($array);
					
					for ($i=0; $i<$foobar; $i++)
  					{
 					 array_push($array, "noanswer");
 					 } 
					return $array;	
}
	public static function createview($questions, $exercise_id, $id){
		
		$status = Exercise::errorarray($exercise_id);
		
    	$id_array=array();
		$category_id=$questions->category_id;
		
		foreach ($questions->question as $question) {
			
			array_push($id_array,$question->number);
		}
		
		foreach ($questions->question as $question) {
			
			
			if($question->number==$id){
				
				$file=strtolower($question->files);
			 if(strpos($file,'jpg') !== false || strpos($file,'png') !== false ||strpos($file,'gif') !== false){
			 	
				$media="image";
			 }
			 elseif(strpos($file,'mp4') !== false || strpos($file,'flv') !== false ||strpos($file,'webm') !== false){
			 	
				$media="video";	
			 	
			 }
			  elseif(strpos($file,'aac') !== false || strpos($file,'mp3') !== false ||strpos($file,'vorbis') !== false){
			 	
				$media="audio";	
			 	
			 }
			  else
			  {
			  	
				$media="nothing";	
			  }
				
				
				$options=array();
				foreach ($question->option as $option) {
				array_push($options, $option->option);
				}
				array_push($options, $question->answer);
				shuffle($options);
				 return View::make('exercises.'.$questions->view.'', compact('question','id_array','id', 'status', 'category_id', 'media', 'options'));
       
			}
		}
        
    }
	
	
}
