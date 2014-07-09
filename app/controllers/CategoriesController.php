<?php

class CategoriesController extends BaseController {

	     protected $layout = 'master';
   
   public function __construct(Category $category)
	{
		$this->category = $category;
   

  $this->beforeFilter('admin', array('only' =>
                            array('edit', 'update','destroy','show')));

    }
	
	
	public function api()
	{
		if (Input::has('index'))
		{
				$list = User::sort_entries(Input::all());
        		$order=$list[0];
        		$sort=$list[1];
       			$page=$list[2];
				$index =Input::get("index");
				return Response::json($this->category->orderBy($sort, $order)->paginate($index));
		}
		
		return Response::json(Category::get());
	
	}
	public function index()
	{
		
     			$pivots = Auth::user()->exercise()->get();
				$categories = Category::all();
				
			
				$category_id = Auth::user()->category_id;
			   	$this->layout->title = 'Categories';
				if(Auth::user()->roles=='User'){
       		   	$this->layout->content = View::make('categories.index', compact('categories','category_id', 'pivots'));
				}
				elseif(Auth::user()->roles=='Admin')
				{
					
					
				$this->layout->content = View::make('categories.admin');
					
				}
	}
		public function sendmessage($id)
	{
		$group = $id;
		$sender = 	Auth::user()->id;
       	$this->layout->title = 'Skicka meddelande';
        $this->layout->content = View::make('categories.messages' , compact('sender','group'));
		

	}
	
		public function categoryupdate()
	{
		
			$category = Category::Find(Input::get("id"));
			
			if (Input::has('title'))
			$category->title = Input::get("title");	
		
			$category->update();
			return Response::json(array('success' => true));
		
	}
	

	public function store()
	{
		
		$category = new Category;
		$category->title = Input::get('title');
		$category->save();
			return Response::json(array('success' => true));
	
	}

	
	public function show($id)  
	{
		$exercises = Category::find($id)->exercise;
		$level = Auth::user()->questionlevel;
		
        $this->layout->title = 'Exercise';
       
        $this->layout->content = View::make('categories.show', compact('exercises', 'level'));
        
	}
	
	
	public function destroy($id)
	{
			
			
		$category = Category::find($id);
		$users = User::where('category_id','=', $id)->get();
		if(count($users)>0){
		 	return Response::json(array('success' => false));
		}else
		{
			$category->delete();
			return Response::json(array('success' => true));
			
			
		}
	}



}
