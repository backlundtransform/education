
<?php


return array(

	
	
	
	"confirmed"            => ":attribute matchar inte varandra.",
	
	"email"                => ":attribute format är ogiltigt.",
	
	"required"             => ":attribute är obligatoriskt.",
	
	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => array(),

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array('username' => "Användarnamn",'password'=>'Lösenord',
	'fornamn'=>'Förnanm','efternamn'=>'Efternamn', 'telefon'=>'Telefonnummer',
		'email'=>'Email' ),

);
?>