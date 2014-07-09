<?php



App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});



Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::guest('login');
	
	if (User::find(Auth::user()->id)->aktiverad == 0) return "Ditt konto har inte aktiverats än";
});
	
	



Route::filter('auth.basic', function()
{
	return Auth::basic();
});

Route::filter('admin', function()	
{
if (Auth::guest()) return Redirect::route('login');

if(isset(Auth::user()->id)){

if (User::find(Auth::user()->id)->roles != 'Admin'){

return Redirect::route('users.show');

}
}




});





Route::filter('user', function($route, $request)
{
    if (Auth::guest()){

     return Redirect::to('login');

}

    elseif( $request->segment(2) != Auth::user()->id && User::find(Auth::user()->id)->roles != 'Admin')
    {
        return Redirect::to('categories');
    }
   });



Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('login');
});


Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});