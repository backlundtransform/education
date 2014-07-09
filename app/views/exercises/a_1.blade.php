@section('container')

 @if(isset($question->question))
 
 <div> {{$question->exercise->description}}</div></br></br>
 @if($media=="image")
 {{HTML::image($question->files)}}</br>

 @elseif($media=="video" || $media=="audio" ) 
 <script src="http://jwpsrv.com/library/Obhm1MYYEeO0eiIACrqE1A.js"></script>
	<div id='playerQSNRSdpmFyHc'></div>
<script type='text/javascript'>
    jwplayer('playerQSNRSdpmFyHc').setup({
        file: '{{asset($question->files)}}',
        image: '{{asset("images/audio.png")}}',
        width: '100%',
        aspectratio: '16:9'
    });
</script>

 @endif
	<b>{{$question->question}}</b></br>


<br />
@if(count($options)>1)
<fieldset data-role="controlgroup" data-type="horizontal" >
	<legend><b>Välj ett svar:</b></legend>
@foreach($options as $key => $option)

<input type="radio" name="radio-choice" id="radio-choice-{{$key}}" value="{{$option}}"  />
     	<label for="radio-choice-{{$key}}">{{$option}}</label>

@endforeach
@else
<textarea id="answer"
></textarea>
@endif
</fieldset>

@if(count($id_array)> array_search($id, $id_array)+1)

<div class="result">
</div>

<button id="a_1" class="answer" data-done="0" data-category_id="{{$category_id}}" data-exercise="{{$question->exercise_id}}"  data-question="{{$id_array[array_search($id, $id_array)]+1}}" data-id="{{$question->id}}">SVARA</button>


<div class="hidden">
{{HTML::link("categories/$category_id/exercises/$question->exercise_id?question=".(array_search($id+1, $id_array)+1), 'Nästa Fråga', array('class'=>'button','data-ajax'=>'false'))}}
</div>
<div class="skip">
{{HTML::link("categories/$category_id/exercises/$question->exercise_id?question=".(array_search($id+1, $id_array)+1), 'Hoppa Över', array('class'=>'button','data-ajax'=>'false'))}}
</div>

@else

<div class="result">
</div>


<button id="a_1" class="answer" data-done="1"  data-category_id="{{$category_id}}" data-exercise="{{$question->exercise_id}}" data-question="{{$id_array[array_search($id, $id_array)]+1}}" data-id="{{$question->id}}">SVARA</button>

<div class="hidden">
{{HTML::link("categories#1", 'Till Nästa Övning', array('class'=>'button','data-ajax'=>'false'))}}
</div>

 @endif

<hr>

<div id="border">

@foreach($status as $key => $value)
	@if($value != "noanswer")
		{{HTML::link("categories/$category_id/exercises/$question->exercise_id?question=".($key+1)  , '', array('class'=>$value ,'data-ajax'=>'false'))}}
	@else
		{{HTML::link("#" , '', array('class'=>$value ,'data-ajax'=>'false'))}}
	@endif
@endforeach   
</div><hr><br />
  @endif
@stop
