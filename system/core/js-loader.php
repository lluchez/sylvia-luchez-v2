<?php

include_once 'abstract-loader.php';


class JsLoader extends AbstractLoader
{

	protected function folder()
	{
		return DIR_JS;
	}

	protected function extension()
	{
		return '.js';
	}

	protected function minified_extension()
	{
		return '.min.js';
	}

	protected function output_mask()
	{
		return "<script type=\"text/javascript\" src=\"%s\"></script>";
	}
  
}