<?php

// include to sent the email
include_once DIR_LIB.'php_mailer/autoload.php';
include_once DIR_CONFIG.'php_mailer.conf.php';


function is_valid_email($email)
{
	return preg_match("/^([^@])+@[A-Za-z0-9\-_\.]+\.[a-z]{2,5}$/i", $email);
}

function create_mailer($config)
{
	$mailer = new PHPMailer(true);
	$mailer->IsSMTP();
	$mailer->Host       = $config["host"];
	$mailer->Port       = $config["port"];
	$mailer->SMTPAuth   = $config["auth"];
	if( $config["auth"] ) {
		$mailer->Username   = $config["username"];
		$mailer->Password   = $config["password"];
		if( $config["transport"] )
			$mailer->SMTPSecure = $config["transport"];
	}
	return $mailer;
}

function send_mail($config, $subject, $message, $to, $from, $options = Array())
{
	// Create the mailer object
	$mailer = create_mailer($config);
	
	// Default options
	if( !isset($options) )           $options = Array();
	if( !isset($options['UTF8']) )   $options['UTF8']   = true; // by default use UTF-8 encoding
	if( !isset($options['isHtml']) ) $options['isHtml'] = true; // by default set content type as HTML
	
	// Set the charset
	if( $options['UTF8'] )
	{
		$mailer->Charset  = 'UTF-8';
		$subject = "=?utf-8?b?".base64_encode($subject)."?=";
	}
	
	// Field the different fields
	$mailer->From     = $from['email'];
	$mailer->FromName = $from['name'];
	$mailer->Subject  = $subject;
	$mailer->MsgHTML($message);
	$mailer->AddAddress($to['email'], $to['name']);
	$mailer->AddReplyTo($from['email'], $from['name']);
	$mailer->IsHTML($options['isHtml']); // send as HTML
	
	// Send the email
	$mailer->Send();
}


