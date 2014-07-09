<?php

class Category extends Eloquent {
	 public function exercise()
    {
        return $this->hasMany('Exercise', 'category_id');
    }
	public static function catarray()
	{
	$catarray=array();
		 $categories = Category::all();
				foreach ($categories as  $key => $category)
				{
				
				$catarray[$category->id] =	$category->title;
				}
			return $catarray;	
	}
}
