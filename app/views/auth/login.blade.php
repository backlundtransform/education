
@section('container')
<br><br><br>

    {{ Form::open(['method' => 'post', 'route' => 'postlogin', 'data-ajax'=>'false'], array('data-ajax'=>'false')) }}
  
    @if (Session::has('login_errors'))
    <span class="error">Användarnamn eller Lösenordet är felaktigt.</span><br>
    @endif

    {{ Form::label('username', 'Användarnamn') }}{{ Form::text('username') }}<br>
 
    {{ Form::label('password', 'Lösenord') }}{{ Form::password('password') }}<br>
   
    {{ Form::submit('Logga in', array('data-role'=>'none')) }}
    {{ Form::close() }}
<br><br><br>Eller:<br>
<table><td>{{HTML::link('/register' , "Skapa ett nytt konto", array('data-ajax'=>'false'))}}</td></table>
<br>
@stop