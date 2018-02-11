<?php

	include_once DIR_CORE.'page.php';


	function parse_query_string($query_string)
	{
		$args = Array();
		$pos = strpos($query_string, '&');
		if( $pos === false )
		{
			$action = $query_string;
		}
		else
		{
			$action = substr($query_string, 0, $pos);
			$query_string = substr($query_string, $pos+1);
			while( $query_string )
			{
				$pos = strpos($query_string, '&');
				if( $pos === false )
				{
					$part = $query_string;
					$query_string = '';
				}
				else
				{
					$part = substr($query_string, 0, $pos);
					$query_string = substr($query_string, $pos+1);
				}

				$pos = strpos($part, '=');
				if( $pos === false )
				{
					$key = $part;
					$val = null;
				}
				else
				{
					$key = substr($part, 0, $pos);
					$val = substr($part, $pos+1);
				}
				$args[] = Array('key' => $key, 'value' => $val);
			}
		}
		return Array('action' => $action, 'args' => $args);
	}

	function render_json($json)
	{
		$page = new Page();
		$page->render_json($json);
	}
