@section('container')


<b>Skicka meddelande till alla användare i {{Category::find($group)->title}}:</b>
<div ng-controller="MessageController" id="Message">

<br /><b>Ämne:</b><br />
        	
        	<input value="" type="text" ng-model="subject">
        	
		 	<br /><b>Meddelande:</b><br />
		 	<textarea ng-model="message"></textarea>
			
            <br/>
            <button ng-click="sendtogroup({{$sender}},{{$group}})">Skicka meddelande</button>
  </div>

@stop