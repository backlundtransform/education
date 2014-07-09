<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	
	protected $table = 'users';

	
	protected $hidden = array('password');
	
	public static $rules = array(
 

        'username' => 'required|unique:users',
        'password'=>'required|confirmed',
        'password_confirmation'=>'required',
		'fornamn'=>'required',
		'efternamn'=>'required',
		
		'email'=>'required|email'

     );

  public static $editrules = array(
 

        'username' => 'required',
        'password'=>'required|confirmed',
        'password_confirmation'=>'required',
		'fornamn'=>'required',
		'efternamn'=>'required',
		
		'email'=>'required|email'

     );
	 
	 public function exercise()
    {
		return $this->belongsToMany('Exercise', 'Pivottables', 'user_id', 'exercise_id')
		->withPivot('id', 'questionlevel','done')
		->withTimestamps();
		
    }
	 public static function validate($data){
             return Validator::make($data, static::$rules);
        }

     public static function editvalidate($data){
             return Validator::make($data, static::$editrules);
        }

	 



	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}


 	public static function usercreate($items)
    {
    	 $user = new User;
            $user->username = $items['username'];
            $user->password = Hash::make($items['password']);
            $user->fornamn = $items['fornamn'];
            $user->efternamn = $items['efternamn'];
            $user->email = $items['email'];
			$user->category_id = $items['category_id'];
			$user->aktiverad  = 1;
            $user->save();
			$excercises=Exercise::all();
			$questions=1;
			foreach ($excercises as $excercise) 
			{
				$user->exercise()->attach(1, array('exercise_id' => $excercise->id, 'user_id' => $user->id, 
				'questionlevel' => $questions
				));
				
			}
			return $user;

    }
	
	public static function useredit($items,$user)
    {
	    	
	    	$user->username = $items['username'];
            $user->password = Hash::make($items['password']);
            $user->fornamn = $items['fornamn'];
            $user->efternamn = $items['efternamn'];
           
            $user->email = $items['email'];
			$user->update();

    }
         
    public static function updatelevel($items)
    {
	    	$user = Auth::user();
					
			$pivots=$user->exercise()->get();
			
		    foreach ($pivots as $pivot){
				if($pivot->pivot->exercise_id==$items['exerciselevel']){
					$pivot->pivot->questionlevel=$items['questionlevel'];
					$pivot->pivot->done=$items['done'];
					$pivot->pivot->update();
				};
				}

    }
          
	 public static function sort_entries($items){

    	if(isset($items['order'])){
       		 $order=$items['order'];
		}
        else
        {

       		$order='desc';
       	 }

       	 if(isset($items['sort'])){
       		 $sort=$items['sort'];

       	 }
        else
        {

            $sort='created_at';
        }
        if(isset($items['page'])){
       
        $page=$items['page'];

        }else{

            $page=1;
        }

		return array($order, $sort, $page);
        }

    
	 public  static function translatetime($delta)
	{
	
	
		if (strpos($delta,'minut') !== false || strpos($delta,'second') !== false ) {
		$delta ="Alldeles nyligen";
		}else{
		$delta = str_replace("hours ","timmar ",$delta);
		$delta = str_replace("hour ","timme ",$delta);
		$delta = str_replace("days","dagar ",$delta);
		$delta = str_replace("day ","dag ",$delta);
 		$delta = str_replace("years ","år ",$delta);
		$delta = str_replace("year ","år ",$delta);
 		
 		$delta = str_replace("ago","sedan",$delta);
	
		}
	return $delta;
}
	public static function creatediagram($user)
	{
		
		$data="['Övning', 'Rätt', 'Fel'],";
		
		$category=Category::find($user->category_id);
	
		$exercises=Category::find($user->category_id)->exercise;
		$pivots=$user->exercise()->where('category_id','=', $user->category_id)->get();
		
		$foobar ="";
		
	
		foreach ($exercises as $key => $exercise){
			
		
			
			if(count($pivots)==count($exercises))
			{
			$result = Result::where('pivot_id', '=', $pivots[$key]->pivot->id);
			$right = count($result->where('result', '=', '1')->get());
			$result = Result::where('pivot_id', '=', $pivots[$key]->pivot->id);
			$wrong = count($result->where('result', '=', '0')->get());
		
			
       		$foobar .= "['".trim($exercises[$key]->title)."' ,".$right."," .$wrong."],";
				
			}	
			
				
		}	
	
		
		return  $data.$foobar;
		
	}
	public static function getpercent($user)
	{
		$pivots=$user->exercise()->get();
			$done=0;
			$count=0;
		 foreach ($pivots as $pivot){
		 	if(Exercise::Find($pivot->pivot->exercise_id)->category_id == $user->category_id){
		 		$count++;
		 	
				if($pivot->pivot->done==1){
					$done++;
					
				}
			}
		 }	
	if($count==0)
	{
		$count=1;
	}
	
		return 100*$done/$count;
	
 }
	public function getReminderEmail()
	{
		return $this->email;
	}
	
	

}