<?php

abstract class AbstractLoader
{
	protected $_files = Array();
	
	abstract protected function folder();
	abstract protected function extension();
	abstract protected function minified_extension();
	abstract protected function output_mask();
	
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
			if( IS_PROD && $minified_exists && (!$asset_exists || filemtime($minified)>=filemtime($asset)) )
				$this->_files[] = $minified;
			elseif( $asset_exists )
				$this->_files[] = $asset;
			elseif( $minified_exists )
				$this->_files[] = $minified;
			else
				die("Can't find ${asset} or ${minified}");
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
