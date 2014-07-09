<?php


class AuthController extends BaseController {

	protected $layout = 'master';


	public function login()
	{

	if (Auth::guest()){
		$this->layout->title = 'Logga in';
		$this->layout->content = View::make('auth/login');
	}
	else{
	return Redirect::to('logged_in');
	}
	
	}
	public function logged_in()
	{

		if (User::find(Auth::user()->id)->roles == 'Admin'){
			
		
			return 	Redirect::to('users');

		}else{
		return Redirect::to('users/'.Auth::user()->id);
		}
		
	}


	public function postlogin()
	{
		// get POST data

		$user = array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        );


		if (Auth::attempt($user))
		{
			
			return Redirect::to('logged_in');
		}
		else
		{
			
			return Redirect::to('login')
			->with('login_errors', true);
			
		}
	}


	public function logout()
	{
		Auth::logout();
		return Redirect::to('login');
	}
}
?>