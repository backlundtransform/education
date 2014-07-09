<?php

class QuestionsController extends BaseController {

	
	    protected $layout = 'master';
		
		public function __construct()
	{
		
		
		$this->beforeFilter('admin', array('only' =>
                            array('index', 'store','update', 'store', 'destroy', 'questionupdate','upload')));

		
	}
   
	

	public function answer_a1()
	{
		if(Input::get("answer")==Question::find(Input::get("id"))->answer){
			Result::resultsave(Input::get("id"), 1);
			return "RÄTT";
			}
		else
			{
			Result::resultsave(Input::get("id"), 0);
			return "FEL";	
			};
	}
	
	public function questionupdate()
	{
		
			$question = Question::Find(Input::get("id"));
			
		if (Input::has('answer'))
			$question->answer = strtolower(Input::get("answer"));
		if (Input::has('question'))
			$question->question = Input::get("question");
		if (Input::has('file'))
			$question->files = Input::get("file");
			
			$question ->update();
			 return Response::json(array('success' => true));
		
	}
	
	
		public function api($id)
	{
				$list = User::sort_entries(Input::all());
        		$order = $list[0];
        		$sort = $list[1];
       			$page = $list[2];
				$index =Input::get("index");
				return Response::json(Exercise::find($id)->question()->orderBy($sort, $order)->paginate($index));
	}
	
	
	 

	

public function upload()
	{
		
			$file = Input::file('file');
			$filename ="";
			
 
		if (Input::hasFile('file'))
         {
        	$destinationPath = 'files/';
			$filename = $file->getClientOriginalName();
			$file->move($destinationPath, $filename);
		
		 }
		
	
	}

	
	public function store()
	{
		
			
			$filename ="";
 
		
		 Question::createquestion(Input::all(), $filename);
		 return Response::json(array('success' => true));
		
	
	}


	
		public function destroy($id)
	{
			
		$question=Question::find($id);
		$exercise_id=$question->exercise_id;
		Result::where('question_id','=',$id)->delete();
		$question->delete();
		$questions=Question::where('exercise_id','=',$exercise_id)->get();
		
		foreach ($questions as $key => $value) {
			$value->number=$key+1; 
			$value->update();
		}
		

		
		return Response::json(array('success' => true));
	}

}
