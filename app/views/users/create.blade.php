@section('container')

 {{ Form::open(['method' => 'post', 'action' => 'UsersController@store', 'enctype'=>'multipart/form-data'], array('data-ajax'=>'false')) }}

   
   
    <table>
<tr>
<td> {{Form::label('username' , 'Användarnamn:')}} </td>
<td> *{{Form::text('username')}} </td>
</tr>
<tr>
<td> {{Form::label('password' , 'Lösenord:')}}</td>
<td> *{{Form::password('password')}}</td>
</tr>
<tr>
<td> {{Form::label('password_confirmation' , 'Bekräfta Lösenord:')}}</td>
<td> *{{Form::password('password_confirmation')}}</td>
</tr>
<tr>
<td> {{Form::label('fornamn' , 'Förnamn:')}} </td>
<td>*{{Form::text('fornamn')}}</td>
</tr>
<tr>
<td> {{Form::label('efternamn' , 'Efternamn:')}}  </td>
<td>*{{Form::text('efternamn')}}</td>
</tr>
<tr>
<td>
      Grupp
						
</td>
<td>
            			{{ Form::select('category_id',  $catarray , 1)}}
						
						</td>
</tr>
<tr>
<td>  {{Form::label('email' , 'Email:')}}  </td>
<td> *{{Form::text('email')}}</td>
</tr>
</table>
   {{Form::submit('Registrera', array('data-role'=>'none')) }} <br>
    {{Form::close()}}

</div>@stop