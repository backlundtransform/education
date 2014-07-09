@section('container')

<b>Meddelande från {{User::find($message->sender)->fornamn}}:</b><br>
<h1>{{$message->subject}}</h1><hr>

{{$message->message}}<hr>

<b>Svara på {{User::find($message->sender)->fornamn}}s meddelande:</b>



<div ng-controller="MessageController" id="Message">

        	<input ng-model="subject" ng-init="subject='RE:{{$message->subject}}'" value="RE:{{$message->subject}}" type="text" >
        	
		 	<br /><b>Meddelande:</b><br />
		 	<textarea ng-model="message"></textarea>
			
            <br/>
            <button ng-click="send({{$message->receiver}},{{$message->sender}})">Skicka meddelande</button>
  </div>

@stop
