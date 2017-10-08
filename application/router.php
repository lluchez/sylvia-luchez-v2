<?php
	// include the config files
	include DIR_CONFIG.'config.php';
	include_once DIR_CORE.'lib.php';
	include_once DIR_APP.'lib/router.php';
	
	
	class NotFoundException extends Exception
	{
		public function __construct($message, $code = 0, Exception $previous = null)
		{
			parent::__construct($message, $code, $previous);
		}
	}
	
	try
	{
		$url_args = parse_query_string($_SERVER['QUERY_STRING']);
		$action = urldecode($url_args['action']);
		if( preg_match("/\.json$/i", $action, $matches) )
		{
			if( preg_match("/^(projects)\.json$/i", $action, $matches) )
			{
				include DIR_APP."pages/".strtolower($matches[1]).".php";
				render_json(generate_collection_json());
			}
			elseif( preg_match("/^(projects)\/([\w\-]+)\.json$/i", $action, $matches) )
			{
				include DIR_APP."pages/".strtolower($matches[1]).".php";
				render_json(generate_item_json($matches[2]));
			}
			elseif( preg_match("/^(projects)\/([\w\-]+)\/image\/([\w\-'\(\)]+\.(jpe?g|png))\.json$/i", $action, $matches) )
			{
				include DIR_APP."pages/".strtolower($matches[1]).".php";
				render_json(generate_image_json($matches[2], $matches[3]));
			}
			else
			{
				throw new NotFoundException("Page '{$action}' not found");
			}
		}
		elseif( preg_match("/^send_contact_email$/i", $action, $matches) )
		{
			include DIR_APP."pages/send_contact_email.php";
		}
		else
		{
			include DIR_APP.'pages/main.php';
		}
	}
	catch(NotFoundException $e)
	{
		set_status_header(404);
		render_json(Array("error" => Array("code" => 404, "text" => $e->getMessage())));
	}
	catch(Exception $e)
	{
		set_status_header(500);
	}
	
	