<?php

function init_get_post_arrays()
{
	// For Angular, as default Content-Type is application/json
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST))
		$_POST = json_decode(file_get_contents('php://input'), true);
	
	foreach($_POST as $key => $val)
		$_POST[$key] = utf8_decode($val);
	
	// merge the two arrays inside $_GET, so we can only work with $_GET
	$_GET += $_POST;
	
	// do some cleaning if 'get_magic_quotes_gpc' parameter is on, and remove strange keys (starting by '|')
	foreach($_GET as $key => $val)
	{
		if( is_string($val) && get_magic_quotes_gpc() ) // magic_quotes mode fix
			$_GET[$key] = stripslashes($val);
	}
}

// Retrieve a key in the $_GET array
function get($key, $default_value = null)
{
	if( is_defined($key) )
		return $_GET[$key];
	else
		return $default_value;
}


// Check if all the the keys are part of the $_GET array
function is_defined($array, $index = null)
{
	if( ! is_array($array) )
	{
		$array = func_get_args();
		$index = null;
	}
	foreach($array as $key)
	{
		if( is_array($key) && !is_null($index) )
		{
			if( ! is_defined($key[$index]) )
				return false;
		}			
		elseif( is_string($key) )
		{
			if( ! isset($_GET[$key]) )
				return false;
		}
	}
	return true;
}


// Check if all the the keys are part of the $_POST array
function is_pDefined()
{
	$array = func_get_args();
	foreach($array as $key) {
		if( ! isset($_POST[$key]) )
			return false;
	}
	return true;
}


// Init the inputs
init_get_post_arrays();

