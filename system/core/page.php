<?php

include_once 'abstract-loader.php';
include_once 'css-loader.php';
include_once 'js-loader.php';

class Page
{

	public $css, $js;

	public function __construct($version_number = null)
	{
		$this->css = new CssLoader($version_number);
		$this->js = new JsLoader($version_number);
	}

	public function write_header($padding = "\t", $eol = "\n")
	{
		$this->css->write($padding, $eol);
		$this->js->write($padding, $eol);
	}

	public function image($relative_url)
	{
		return DIR_IMG.$relative_url;
	}

	public function render_json($json_text)
	{
		if( ! is_string($json_text) )
			$json_text = json_encode($json_text);
		header("Content-Type: application/json");
		die($json_text);
	}
}