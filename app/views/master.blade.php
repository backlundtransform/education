
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, height=device-height">
<title>{{$title}}</title>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>

<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css">

<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>

	<script data-require="angular.js@1.2.x" type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular.min.js"></script>
           {{ HTML::script('js/app.js'); }}
        {{ HTML::script('js/controllers/maincontroller.js'); }}
        {{ HTML::script('js/services/service.js'); }}

{{HTML::style('css/layout.css');}}


</head>
<body>
	
  

		<div data-url="panel-responsive-page1" data-role="page" class="jqm-demos ui-responsive-panel"  id="page" >
    <div data-role="header">
    	
        <h1>Varoid Education</h1>
        <a href="#nav-panel" data-icon="bars" data-iconpos="notext">Menu</a>
    
    </div>  <div role="main" class="ui-content jqm-content jqm-fullwidth" >
    	<div id="block"></div>
	<div class="innertube"> 




     




<br /><br />


 @if( $errors->count() > 0 )
 <div id="errors">
 	
    <p>Följade fel inträffade:</p>

    <ul id="form-errors">
        {{ $errors->first('username', '<li>:message</li>') }}
        {{ $errors->first('password', '<li>:message</li>') }}
        {{ $errors->first('password_confirmation', '<li>:message</li>') }}
        {{ $errors->first('fornamn', '<li>:message</li>') }}
        {{ $errors->first('telefon', '<li>:message</li>') }}
        {{ $errors->first('email', '<li>:message</li>') }}
         {{ $errors->first('message', '<li>:message</li>') }}
    </ul>

    </div>
@endif

@if(Session::has('message'))
	<div id="showmessage" class="alert-box success" >
      <p>{{ Session::get('message') }} </p>
    </div>
@endif
@if(Session::has('mobile'))    
    <script>location.replace("{{ Session::get('mobile') }}");
</script>
@endif
	
<br /><br />

<div ng-app="myapp"> <div ng-controller="MainController"></div> 

@yield('container')

</div>
</div>

 <div data-demo-html="#panel-responsive-page1"></div>
 
 
@if(Auth::user())
{{ HTML::script('js/userscriptet.js'); }}

@if(Auth::user()->roles == 'Admin')
{{ HTML::script('js/adminscriptet.js'); }}
{{HTML::script('js/ckeditor/ckeditor.js');}}
@endif
@endif
        <br>
        <br>
        <br>
        <br>
        <br>
        <a href="#" data-rel="back" data-ajax="false" onclick="history.go(-1)" class="ui-btn ui-shadow ui-corner-all ui-mini ui-btn-inline ui-icon-carat-l ui-btn-icon-left ui-alt-icon ui-nodisc-icon">Gå tillbaka</a>
      
    
    
    </div>
    <div data-role="panel" data-display="push" data-theme="b" id="nav-panel">
        <ul data-role="listview">
            <li data-icon="delete"><a href="#" data-rel="close">Stäng menu</a></li>
              
                @if(Auth::user())	
					@if(Auth::user()->roles == 'User')
    		 		<li>{{HTML::link('users/'.Auth::user()->id, 'Min sida', array('data-ajax'=>'false'))}}</li>
    		 				<li>{{HTML::link('categories#'.Auth::user()->category_id, 'Övningar', array('data-ajax'=>'false'))}}</li>
					@elseif(Auth::user()->roles == 'Admin')
					
						<li>{{HTML::link('users', 'Elever', array('data-ajax'=>'false'))}}</li>
						<li>{{HTML::link('exams', 'Filer', array('data-ajax'=>'false'))}}</li>
						<li>{{HTML::link('categories', 'Grupper', array('data-ajax'=>'false'))}}</li>
						<li>{{HTML::link('exercises', 'Övningar', array('data-ajax'=>'false'))}}</li>
					@endif
						<li>{{HTML::link('larare', 'Lärare', array('data-ajax'=>'false'))}}</li>
						<li>{{HTML::link('messages', "Meddelanden(".count(Message::where('receiver','=', Auth::user()->id)->where('read','=', '0')->get()).")", array('data-ajax'=>'false'))}}</li>
						<li>{{HTML::link('logout', 'Logga ut', array('data-ajax'=>'false'))}}</li>
					@endif
        </ul>
    </div>
    
</div>
</body>



</html>