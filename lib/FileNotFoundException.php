<?php

namespace QuickView;

use \Exception;

/**
 * Exception thrown when no file to print found
 *
 * @author	izisaurio
 * @version	1
 */
class FileNotFoundException extends Exception
{
	/**
	 * Constructor
	 *
	 * @access	public
	 * @param	string		$path	File path not found
	 */
	public function __construct($path)
	{
		parent::__construct("File to print not found (Path: {$path})");
	}
}
