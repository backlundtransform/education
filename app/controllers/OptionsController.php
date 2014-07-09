<?php

class OptionsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('options.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('options.create');
	}


	public function store()
	{
	 	
		
	 Option::optioncreate(Input::all());
	
	}

	
	public function show($id)
	{
        return View::make('options.show');
	}

	
	public function edit($id)
	{
        return View::make('options.edit');
	}

	
	public function update($id)
	{
		//
	}

	
	public function destroy($id)
	{
		//
	}

}
