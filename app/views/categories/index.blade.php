@section('container')
<br>


 
   <ul>

@foreach($categories as $category)
<ul class="accordion">
 

   <li id="{{$category->id}}">
<a href="#{{$category->id}}" data-ajax="false"> {{ $category->title}}<span>{{count($category->exercise)}}</span></a>
   


 @if($category_id==$category->id)
     <ul class="sub-menu">
@foreach($category->exercise as $key=> $exercise)
		
		  
	
	@if($exercise->locked)
	
	 <li><a href="#" data-ajax="false"><img src="images/locked.png" align="middle"/><p class="innertube">{{$exercise->title}}</p><span>{{count($exercise->question)}}</span></a></li>
  
	@elseif($pivots[$key]->pivot->done==1)
	<li><a href={{"categories/$category->id/exercises/$exercise->id?question=1"}} data-ajax="false"><img src="images/checked.png" align="middle"/><p class="innertube">{{ $exercise->title}}</p><span>0</span></a></li>
  
   	 
    @else
    <li><a href={{"categories/$category->id/exercises/$exercise->id?question="}}{{$pivots[$key]->pivot->questionlevel}}  data-ajax="false"><img src="images/unlocked.png" align="middle"/><p class="innertube">{{$exercise->title}}</p><span>{{count($exercise->question)+1-$pivots[$key]->pivot->questionlevel}}</span></a></li>
  
  
   @endif
		
	
	
	@endforeach

     </ul>
 
</li>
 @endif
	
 <br>
@endforeach

  </ul>

@stop

