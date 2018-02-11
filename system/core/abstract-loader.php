<?php

abstract class AbstractLoader
{
	protected $version_number;
	protected $_files = Array();

	abstract protected function folder();
	abstract protected function extension();
	abstract protected function minified_extension();
	abstract protected function output_mask();

	public function __construct($version_number)
	{
		$this->version_number = $version_number;
	}

	public function add()
	{
		$this->__add(func_get_args(), $this->folder());
	}

	public function addBower()
	{
		$this->__add(func_get_args(), DIR_BOWER);
	}

	private function __add($files, $path)
	{
		$ext	= $this->extension();
		$mini = $this->minified_extension();
		foreach($files as $file)
		{
			$asset = $path.$file.$ext;
			$minified = $path.$file.$mini;
			$asset_exists = file_exists($asset);
			$minified_exists = file_exists($minified);
			$resource_path = null;
			if( IS_PROD && $minified_exists && (!$asset_exists || filemtime($minified)>=filemtime($asset)) )
				$resource_path = $minified;
			elseif( $asset_exists )
				$resource_path = $asset;
			elseif( $minified_exists )
				$resource_path = $minified;

			if( empty($resource_path) )
				die("Can't find ${asset} or ${minified}");
			$this->_files[] = "{$resource_path}?v={$this->version_number}";
		}
	}

	public function write($padding = "\t", $eol = "\n")
	{
		$mask = $this->output_mask();
		foreach( $this->_files as $file )
		{
			echo($padding.sprintf($mask, $file).$eol);
		}
	}
}
