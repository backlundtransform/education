@section('container')
<div ng-controller="MessageController" id="Message">
<b>Skicka meddelande till {{User::find($receiver)->fornamn}}:</b>

<br /><b>Ämne:</b><br />
        	
        	<input value="" type="text" ng-model="subject">
        	
		 	<br /><b>Meddelande:</b><br />
		 	<textarea ng-model="message"></textarea>
			
            <br/>
            <button ng-click="send({{$sender}},{{$receiver}})">Skicka meddelande</button>
  </div>

@stop