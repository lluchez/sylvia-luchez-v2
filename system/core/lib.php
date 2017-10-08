<?php

function browser_only_supports_jquery1()
{
	$agent = $_SERVER['HTTP_USER_AGENT']; $matches = Array();
	if(preg_match("/ MSIE (\d+)/i", $agent, $matches) && !preg_match("/opera/i", $agent)) {
		return intval($matches[1]) < 9; // && IS_PROD;
	} elseif(preg_match("/Trident\/(\d+)/i", $agent, $matches)) { // MSIE
		return intval($matches[1]) < 5;// && IS_PROD;
	}
	return false;
}


function str_starts_with($haystack, $needle)
{
	return ($needle === "") || (strrpos($haystack, $needle, -strlen($haystack)) !== false);
}

function str_ends_with($haystack, $needle)
{
	return ($needle === "") || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
}

function filter_panels($file)
{
	return ( str_starts_with($file, 'panel-') && str_ends_with($file, '.php') );
}

if ( ! function_exists('set_status_header'))
{
	/**
	 * Set HTTP Status Header
	 *
	 * @param	int	the status code
	 * @param	string
	 * @return	void
	 */
	function set_status_header($code = 200, $text = '')
	{
		if (empty($code) OR ! is_numeric($code))
		{
			show_error('Status codes must be numeric', 500);
		}

		if (empty($text))
		{
			is_int($code) OR $code = (int) $code;
			$stati = array(
				200	=> 'OK',
				201	=> 'Created',
				202	=> 'Accepted',
				203	=> 'Non-Authoritative Information',
				204	=> 'No Content',
				205	=> 'Reset Content',
				206	=> 'Partial Content',

				300	=> 'Multiple Choices',
				301	=> 'Moved Permanently',
				302	=> 'Found',
				303	=> 'See Other',
				304	=> 'Not Modified',
				305	=> 'Use Proxy',
				307	=> 'Temporary Redirect',

				400	=> 'Bad Request',
				401	=> 'Unauthorized',
				403	=> 'Forbidden',
				404	=> 'Page Not Found',
				405	=> 'Method Not Allowed',
				406	=> 'Not Acceptable',
				407	=> 'Proxy Authentication Required',
				408	=> 'Request Timeout',
				409	=> 'Conflict',
				410	=> 'Gone',
				411	=> 'Length Required',
				412	=> 'Precondition Failed',
				413	=> 'Request Entity Too Large',
				414	=> 'Request-URI Too Long',
				415	=> 'Unsupported Media Type',
				416	=> 'Requested Range Not Satisfiable',
				417	=> 'Expectation Failed',
				422	=> 'Unprocessable Entity',

				500	=> 'Internal Server Error',
				501	=> 'Not Implemented',
				502	=> 'Bad Gateway',
				503	=> 'Service Unavailable',
				504	=> 'Gateway Timeout',
				505	=> 'HTTP Version Not Supported'
			);

			if (isset($stati[$code]))
			{
				$text = $stati[$code];
			}
			else
			{
				$text = 'Invalid error code';
			}
		}

		if (strpos(PHP_SAPI, 'cgi') === 0)
		{
			header('Status: '.$code.' '.$text, TRUE);
		}
		else
		{
			$server_protocol = isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.1';
			header($server_protocol.' '.$code.' '.$text, TRUE, $code);
		}
	}
}

function default_error_handler($errno, $errstr, $errfile, $errline)
{
	if( !(error_reporting() & $errno) )
	{
		return; // This error code is not included in error_reporting
	}

	switch( $errno )
	{
		case E_USER_ERROR:
		case E_ERROR:
			echo "<b>My ERROR</b> [$errno] $errstr<br />\n";
			echo "  Fatal error on line $errline in file $errfile";
			echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
			echo "Aborting...<br />\n";
			set_status_header(500);
			exit(1);
			break;

		case E_USER_WARNING:
			echo "<b>My WARNING</b> [$errno] $errstr<br />\n";
			break;

		case E_USER_NOTICE:
			echo "<b>My NOTICE</b> [$errno] $errstr<br />\n";
			break;

		default:
			echo "Unknown error type: [$errno] $errstr<br />\n";
			break;
	}

	return true; /* Don't execute PHP internal error handler */
}

function format_filesize($bytes, $not_existing_text = '')
{
	if ($bytes >= 1073741824)
		return number_format($bytes / 1073741824, 2) . ' GB';
	elseif ($bytes >= 1048576)
		return number_format($bytes / 1048576, 2) . ' MB';
	elseif ($bytes >= 1024)
		return number_format($bytes / 1024, 2) . ' kB';
	elseif ($bytes > 1)
		return $bytes . ' bytes';
	elseif ($bytes == 1)
		return $bytes . ' byte';
	elseif ($bytes == 0)
		return '0 bytes';
	else
		return $not_existing_text;
}