<?php 


class ExamsController extends BaseController {

	
	protected $exam;
	 protected $layout = 'master';

	public function __construct(Exam $exam)
	{
		$this->exam = $exam;
		
		$this->beforeFilter('admin', array('only' =>
                            array('index', 'store','examupdate','destroy')));

		
	}

	
	public function index()
	{
		
		
		$list = User::sort_entries(Input::all());
        $order=$list[0];
        $sort=$list[1];
        $page=$list[2];

		$catarray=Category::catarray();
		$exams = $this->exam->orderBy($sort, $order)->paginate(3);
		
		$this->layout->title = 'Prov';
        $this->layout->content =  View::make('exams.index', compact('exams', 'page','order','sort','catarray'));
	}

	

	
	public function store()
	{
		
		  $exam = new Exam;
		  if (Input::has('title'))
            $exam->title = Input::get('title');
			if (Input::has('category_id'))
            $exam->category_id =  Input::get('category_id');
			if (Input::has('files'))
            $exam->files = Input::get('files');
            $exam->save();
			
		
    
	
 return Response::json(array('success' => true));
	
		
	}
	
	
	
	public function api()
	{
			
			
			$list = User::sort_entries(Input::all());
        		$order=$list[0];
        		$sort=$list[1];
       			$page=$list[2];
		
				
				
		if (Input::has('category_id')){
			$index =Input::get("index");
			$category_id=Input::get('category_id');
		return Response::json($this->exam->where('category_id', '=', $category_id)->orderBy($sort, $order)->paginate($index));
		
		}else{
			$index =Input::get("index");
			return Response::json($this->exam->orderBy($sort, $order)->paginate($index));
		
			
		}
		
	
	}

	public function examsupdate()
	{
				
				
			$exam = Exam::Find(Input::get("id"));
		    if (Input::has('category_id'))
			$exam->category_id = Input::get("category_id");
			if(Input::has('title'))
			$exam->title = Input::get("title");	
			
			$exam->update();
				return Response::json(array('success' => true));
	
	}

	
	public function destroy($id)
	{
		$this->exam->find($id)->delete();

		return Response::json(array('success' => true));
	}

}
