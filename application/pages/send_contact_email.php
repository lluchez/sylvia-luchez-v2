<?php

// include to sent the email
include_once DIR_CORE.'get_post.php';
include_once DIR_APP.'lib/email.php';



function clean_text($text)
{
	return utf8_decode(preg_replace("#[<>]#", "", $text));
}

function render_json_error($message)
{
	render_json(Array("error" => $message));
}

function handle_send_contact_email_request()
{
	// Configuration data
	global $config;
	$owner_email_config = $config["owner_email"];
	$mailer_config = $config["php_mailer"];
	
	// Reading fields
	$name = utf8_encode(trim(get("name")));
	$mail = utf8_encode(trim(get("email")));
	$phon = utf8_encode(trim(get("phone")));
	$subj = utf8_encode(trim(get("subject")));
	$text = utf8_encode(trim(get("message")));
	//$code = utf8_encode(trim(get(POST_MAIL_CODE)));
	
	// Verify fields
	if( !$name ) render_json_error('Please indicate your identity');
	if( !$mail ) render_json_error('Please indicate your email address');
	if( !is_valid_email($mail) )
		render_json_error('Please indicate a valid email address');
	if( !$subj ) render_json_error('Please indicate the subject of your inquiry');
	if( !$text ) render_json_error('Please indicate explain why you want to contact the artist');
	//if( !$code ) render_json_error('Please copy the code security code');
	//if( $_SESSION['sess_security_code'] !== md5($code) )
	//	render_json_error('Invalid security code');
	
	// Prepare data to be sent
	$subject = $subj . ' - Web site inquiry';
	$content = '<!DOCTYPE html><html><body><p>The following message has been sent via '.$_SERVER['SERVER_NAME'].' on '.date("d-m-Y H:i:s")
		.' by '.htmlspecialchars($name).'.</p><hr /><br />'.nl2br(htmlspecialchars($text), false)
		.'<br /><hr />Name: '.htmlspecialchars($name).'<br />Email: '.htmlspecialchars($mail).'<br />Phone: '.htmlspecialchars($phon).'<br /></body></html>';
	$to   = $owner_email_config;
	$from = Array('name' => clean_text($name), 'email' => clean_text($mail));
	
	// Send the email
	try {
		send_mail($mailer_config, $subject, $content, $to, $from);
		render_json( Array("success" => true, "recipient" => $owner_email_config["name"], "sender" => $name) );
	} catch (phpmailerException $e) {
		render_json_error("Unable to sent the email: ".$e->getMessage());
	} catch (Exception $e) {
		render_json_error("Unable to sent the email");
	}
}


if( is_pDefined("name", "email", "phone", "subject", "message") )
{
	handle_send_contact_email_request();
}
else
{
	render_json_error("Invalid data provided");
}

