<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/



	Route::get('login', array('as' => 'login', 'uses' => 'AuthController@login'));
	Route::post('postlogin', array('as' => 'postlogin', 'uses' => 'AuthController@postlogin'));
	Route::get('register', array('as' => 'register', 'uses' => 'UsersController@create'));
	Route::post('store', array('as' => 'store', 'uses' => 'UsersController@store'));
	
	Route::post('categories/store', array('as' => 'store', 'uses' => 'CategoriesController@store'));
	Route::group(array('before' => 'auth'), function(){
	Route::get('nylarare', array('as' => 'nylarare', 'uses' => 'UsersController@nylarare'));
	Route::get('logout', array('as' => 'logout', 'uses' => 'AuthController@logout'));
	Route::get('categories/{category_id}/exercises/{id}', array('as' => 'view', 'uses' => 'ExercisesController@show'));
	Route::get('larare', array('as' => 'larare', 'uses' => 'UsersController@larare'));
	Route::get('createwrong', array('as' => 'createwrong', 'uses' => 'UsersController@createwrong'));
	Route::resource('logged_in', 'AuthController@logged_in');
	Route::resource('users', 'UsersController');
	Route::resource('pivottables', 'PivottablesController');
	Route::resource('exercises', 'ExercisesController');
	Route::resource('exams', 'ExamsController');
	Route::resource('categories', 'CategoriesController');
	Route::resource('messages', 'MessagesController');
	Route::resource('questions', 'QuestionsController');
	Route::resource('categories/{id}/exercises/{exercise_id}/questions', 'QuestionsController');
	Route::get('examupdate', array('as' => 'examupdate', 'uses' => 'ExamsController@examupdate'));
	Route::post('categoryupdate', array('as' => 'categoryupdate', 'uses' => 'CategoriesController@categoryupdate'));
	Route::get('exerciseupdate', array('as' => 'exerciseupdate', 'uses' => 'ExercisesController@exerciseupdate'));
	Route::post('exerciseupdate', array('as' => 'exerciseupdate', 'uses' => 'ExercisesController@exerciseupdate'));
	Route::post('examsupdate', array('as' => 'examsupdate', 'uses' => 'ExamsController@examsupdate'));
	Route::get('examsupdate', array('as' => 'examsupdate', 'uses' => 'ExamsController@examsupdate'));
	Route::get('api/exams', array('as' => 'api', 'uses' => 'ExamsController@api'));
	Route::get('api/exercises', array('as' => 'api', 'uses' => 'ExercisesController@api'));
	Route::get('api/categories', array('as' => 'api', 'uses' => 'CategoriesController@api'));
	Route::get('api/users', array('as' => 'api', 'uses' => 'UsersController@api'));
	Route::get('api/messages', array('as' => 'destroy', 'uses' => 'MessagesController@api'));
	Route::get('exercises/destroy/{id}', array('as' => 'destroy', 'uses' => 'ExercisesController@destroy'));
	Route::get('api/{exercise_id}/questions', array('as' => 'api', 'uses' => 'QuestionsController@api'));
	Route::post('questionupdate', array('as' => 'questionupdate', 'uses' => 'QuestionsController@questionupdate'));
	Route::get('users/{id}/sendmessage', array('as' => 'sendmessage', 'uses' => 'UsersController@sendmessage'));
	Route::get('categories/{id}/sendmessage', array('as' => 'sendmessage', 'uses' => 'CategoriesController@sendmessage'));
	Route::resource('questions', 'QuestionsController');
	Route::post('userupdate', array('as' => 'userupdate', 'uses' => 'UsersController@userupdate'));
	Route::post('level', array('as' => 'level', 'uses' => 'UsersController@level'));
	Route::get('answer_a1', array('as' => 'answer_a1', 'uses' => 'QuestionsController@answer_a1'));
	Route::post('questions/store', array('as' => 'store', 'uses' => 'QuestionsController@store'));
	Route::get('name/{id}', array('as' => 'name', 'uses' => 'MessagesController@name'));
	Route::get('exams/destroy/{id}', array('as' => 'destroy', 'uses' => 'ExamsController@destroy'));
	Route::get('messages/destroy/{id}', array('as' => 'destroy', 'uses' => 'MessagesController@destroy'));
	Route::get('questions/destroy/{id}', array('as' => 'destroy', 'uses' => 'QuestionsController@destroy'));
	Route::get('categories/destroy/{id}', array('as' => 'destroy', 'uses' => 'CategoriesController@destroy'));
	Route::get('users/destroy/{id}', array('as' => 'destroy', 'uses' => 'UsersController@destroy'));
	Route::post('questions/upload', array('as' => 'upload', 'uses' => 'QuestionsController@upload'));
	Route::get('admin', array('as' => 'admin', 'uses' => 'UsersController@admin'));
	Route::post('upload/file', array('as' => 'store', 'uses' => 'ExamsController@store'));
	Route::post('send/messages', array('as' => 'send', 'uses' => 'MessagesController@store'));
	Route::post('options/store', array('as' => 'store', 'uses' => 'OptionsController@store'));
	Route::post('exercises/store', array('as' => 'store', 'uses' => 'ExercisesController@store'));
		
	Route::resource('options', 'OptionsController');
	
});










Route::resource('messages', 'MessagesController');

