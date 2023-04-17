<?php

namespace QuickView;

use \Exception;

/**
 * Exception thrown when no template file found
 *
 * @author	izisaurio
 * @version	1
 */
class TemplateNotFoundException extends Exception
{
	/**
	 * Constructor
	 *
	 * @access	public
	 * @param	string		$path	File path not found
	 */
	public function __construct($path)
	{
		parent::__construct("Template file not found (Path: {$path})");
	}
}
