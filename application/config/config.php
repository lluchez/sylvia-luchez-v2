<?php

	// Set if we are in Production environment
	define('IS_PROD', strpos($_SERVER['SERVER_NAME'], '192.168.') !== 0);
	
	// Define configuration array
	$config = Array();

	
	$config["owner_email"] = Array
	(
		"name" => "Sylvia Luchez",
		"email" => "sylvia.luchez@gmail.com"
	);
	