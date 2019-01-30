<?php

function generate_php_mailer_config()
{
	$config = Array();
	
	// - - - - SMTP data - - - -
	if( $_SERVER['SERVER_ADDR'] === '127.0.0.1' )
	{
		$config['host'] = 'localhost';
		$config['port'] = 25;
		$config['auth'] = false;
	}
	else
	{
		$config['host'] = $_ENV['SMTP_HOST'];
		$config['port'] = $_ENV['SMTP_PORT'];
		$config['auth'] = true;
		$config['username'] = $_ENV['SMTP_USERNAME'];
		$config['password'] = $_ENV['SMTP_PASSWORD']; // Generated using https://support.google.com/accounts/answer/185833?hl=en (2-step verification needs to be activated)
		$config['transport'] = 'ssl';
	}
	return $config;
}

$config["php_mailer"] = generate_php_mailer_config();
