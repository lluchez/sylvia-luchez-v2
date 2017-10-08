<?php

include_once 'abstract-loader.php';


class CssLoader extends AbstractLoader
{

	protected function folder()
	{
		return DIR_CSS;
	}

	protected function extension()
	{
		return '.css';
	}

	protected function minified_extension()
	{
		return '.min.css';
	}

	protected function output_mask()
	{
		return "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"%s\" />";
	}
}