<?php

class UsersController extends BaseController {

  
     protected $layout = 'master';
   
   public function __construct(User $users)
    {
        $this->users=$users;
 		 $this->beforeFilter('guest', array('only' =>
                            array('create')));
   
    	 $this->beforeFilter('user', array('only' =>
                            array('show','edit')));
   		 $this->beforeFilter('admin', array('only' =>
                            array('index','destroy', 'userupdate','nylarare')));

    }
    public function index()
    {
    	
	
    	
		$list = User::sort_entries(Input::all());
        $order=$list[0];
        $sort=$list[1];
        $page=$list[2];

		
	
       
		$catarray=Category::catarray();
		
		

        $users = User::where('roles','=', 'user')->orderBy($sort, $order)->paginate(3);
        
        $this->layout->title = 'Elever';
       
        $this->layout->content = View::make('users.index', compact('users','order','sort','page', 'catarray'));
       

    }
	
	public function api()
	{
				$list = User::sort_entries(Input::all());
        		$order=$list[0];
        		$sort=$list[1];
       			$page=$list[2];
				$index =Input::get("index");
				return Response::json(User::where('roles','=', Input::get("role"))->orderBy($sort, $order)->paginate($index));
		
	
	}
	
	public function sendmessage($id)
	{
		$receiver = $id;
		$sender = 	Auth::user()->id;
       	$this->layout->title = 'Skicka meddelande';
        $this->layout->content = View::make('users.messages' , compact('sender','receiver'));
		

	}
	
	 public function larare()
  {
    	
		$list = User::sort_entries(Input::all());
        $order=$list[0];
        $sort=$list[1];
        $page=$list[2];

        $users = User::where('roles','=', 'Admin')->orderBy($sort, $order)->paginate(3);
        
        $this->layout->title = 'Lärare';
        
        $this->layout->content = View::make('users.larare', compact('users','order','sort','page'));
       

    }
public function nylarare()
 {
	$user = User::where('email','=', Input::get("email"))->first();
	if(is_object($user)){
	 	$user->roles="Admin";
		$user->category_id="0";
	 	$user->update();
		return Response::json(array('success' => true));
	}
	else
	{
		
			
			return Response::json(array('success' => false));
	}
	
	}
	
    public function store()
    {
    	
		
		 $validation = User::validate(Input::all());
        if($validation->fails()){
			return Redirect::to('register')->withErrors($validation);
        }

        else{
    		User::usercreate(Input::all());
	    	return Redirect::to('login');
		}
	}

    
    public function show($id)
    {
    	
	    $user = User::find($id);
		
		$percent=User::getpercent($user);
		$list = User::sort_entries(Input::all());
        $order=$list[0];
        $sort=$list[1];
        $page=$list[2];

		$sfi = Category::catarray();
		
	
		$data=User::creatediagram($user);
		$exams = Exam::where('category_id','=', $user->category_id)->orderBy($sort, $order)->paginate(3);
		$this->layout->title = $user->username;
		if($user->roles == 'User')
		{
			if(Input::get('statistics')==true){
       		return View::make('users.stat', compact('user','data'));
		
			}
			else
			{
			 
			 $this->layout->content = View::make('users.show', compact('user','exams','order','sort','page','percent','sfi'));
				
					
			}
			
		}
		else
			{
				
		return Redirect::to('users');
				
			}
     
    }

        
 public function create()
 	{

		   $this->layout->title = "Registrera";
		   $catarray = Category::catarray();
        $this->layout->content = View::make('users.create', compact('catarray'));
 }

 public function edit($id)
    {
        $users = User::Find($id);
        $this->layout->title = 'Edit Profile';
        $this->layout->content = View::make('users.edit', compact('users'));
    }

   

public function level()
    {

      if (Request::ajax()) 
    {
    	
		User::updatelevel(Input::all());
      
	}   

  }


    public function update($id)
    {

       $validation = User::editvalidate(Input::all());
        if($validation->fails())
        {
			return Redirect::to('users/'.$id.'/edit')->withErrors($validation);
        }

        else
        {
         User::useredit(Input::all(), User::Find($id));
         } 
       
      return Redirect::to('users/'.$id);
        
    }
	
	public function userupdate()
	{
				
			$user = User::Find(Input::get("id"));
			if (Input::has('category_id'))
			$user->category_id = Input::get("category_id");
			if (Input::has('aktiverad'))
			$user->aktiverad = Input::get("aktiverad");	
			$user->update();
			return Response::json(array('success' => true));
	}
	
     
   	public function destroy($id)
	{
		User::Find($id)->delete();

	return Response::json(array('success' => true));
	}


}