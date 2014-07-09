<?php

class MessagesController extends BaseController {
	
	protected $layout = 'master';
	 
  
	public function index()
	{
			
	
       
       	$this->layout->title = 'meddelande';
        $this->layout->content = View::make('messages.index' );
	}

public function name($id){
	
		return Response::json(User::find($id)->fornamn);
		
	}
	public function api()
	{
			
		$list = User::sort_entries(Input::all());
        $order=$list[0];
        $sort=$list[1];
        $page=$list[2];
		if(Input::get("sent")=='true'){
			$messages = Message::where('sender', '=', Auth::user()->id)->orderBy($sort, $order)->paginate(Input::get("index"));
		}else{
			$messages = Message::where('receiver', '=', Auth::user()->id)->orderBy($sort, $order)->paginate(Input::get("index"));
		}
       	return Response::json($messages);
	}
	
	
	public function store()
	
	{
		
		
	if(Input::has('receiver')){
			$message = new Message;
			$message->subject = Input::get('subject');
			$message->message = Input::get('message');
			$message->sender = Input::get('sender');
			$message->receiver = Input::get('receiver');
			$message->save();
			
			return Response::json(array('success' => true));
	}
			if(Input::has('group')){
				
				$users= User::where('category_id','=',Input::get('group'))->where('roles','=','User')->get();
			if(count($users)>0)
			{
				
				foreach ($users as $key => $user) {
					
						$message = new Message;
						$message->subject = Input::get('subject');
						$message->message = Input::get('message');
						$message->sender = Input::get('sender');
						$message->receiver = $user->id;
						$message->save();
			
				}
					
					return Response::json(array('success' => true));
					
				}
				else
				{
					
					return Response::json(array('success' => false));
				}
				
				
			
				
			}
			
			
	}
	


	public function show($id)
	{
		$message = Message::find($id);
		
	 if($message->receiver == Auth::user()->id){
		if($message->read == 0)
		{
			$message->read = '1';
			$message->update();
		}
		
       	$this->layout->title = 'meddelande';
        $this->layout->content = View::make('messages.show' , compact('message'));
		}
	 elseif ($message->sender == Auth::user()->id) {
			$this->layout->title = 'meddelande';
        $this->layout->content = View::make('messages.show' , compact('message'));
	 }
	}

	public function destroy($id)
	{
		$message = Message::find($id);
		$message->delete();
		return Response::json(array('success' => true));
	}

}
