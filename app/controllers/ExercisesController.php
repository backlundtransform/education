<?php

class ExercisesController extends BaseController {
	
	protected $layout = 'master';
	
	 public function __construct(Exercise $exercise)
	{
		$this->exercise = $exercise;
		$this->beforeFilter('admin', array('only' =>
                            array('index','edit', 'update','destroy','exerciseupdate')));
	 }

	public function index()
	{
       
		
		$catarray=Category::catarray();
				
		$exercises=$this->exercise->get();
        $this->layout->title = 'Övningar';
        $this->layout->content = View::make('exercises.index', compact('exercises','catarray'));
        
	}
	
	
	
		public function api()
	{
				$list = User::sort_entries(Input::all());
        		$order=$list[0];
        		$sort=$list[1];
       			$page=$list[2];
				$index =Input::get("index");
				return Response::json($this->exercise->orderBy($sort, $order)->paginate($index));
	}
	
	
	
	
	public function exerciseupdate()
	{
		
			$exercise = Exercise::Find(Input::get("id"));
			if (Input::has('category_id'))
			$exercise->category_id = Input::get("category_id");
			if (Input::has('locked'))
			$exercise->locked = Input::get("locked");
			if (Input::has('title'))
			$exercise->title = Input::get("title");	
			if (Input::has('description'))
			$exercise->description = Input::get("description");	
			$exercise->update();
			return Response::json(array('success' => true));
		
	}
	
	
	

	
	public function store()
	{
		Exercise::exercisecreate(Input::all());
		
		return  Response::json(array('success' => true));
		
		
	}
	public function create()
 	{
 		
		$catarray=Category::catarray();
        $this->layout->title = "Skapa övning";
        $this->layout->content = View::make('exercises.create', compact('catarray'));
 	}
	
	public function show($category_id, $id)
	{
       $this->layout->title = "Frågor";
       $this->layout->content =  Exercise::createview(Exercise::find($id),$id,Input::get('question'));
   
	}

	
	public function edit($id)
	{
        $this->layout->title = 'Redigera frågor';
		
		$exercise=Exercise::find($id);
	    $this->layout->content =  View::make('exercises.'.$exercise->view.'_edit', compact('questions','exercise', 'sort', 'order'));
	}

	
	
	
	 public function destroy($id)
	 {
				
		 $this->exercise->find($id)->user()->detach();	
		 $questions=$this->exercise->find($id)->question()->get();
		foreach ($questions as $key => $question) 
		{
			$results=Result::where('question_id','=', $question->id)->get();
			foreach ($results as $key => $result)
			{
			 $result->delete();
			}
		}
			$this->exercise->find($id)->question()->delete();
			$this->exercise->find($id)->delete();
		return Response::json(array('success' => true));
	}


}
