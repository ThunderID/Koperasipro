<?php 

namespace App\JadwalPenagihanAngsuran\Services;

/**
 * Abstract class for services
 * 
 * @author cmooy
 */
abstract class BaseService 
{
	protected $errors;

	/* ---------------------------------------------------------------------------- ERRORS ----------------------------------------------------------------------------*/
	
	/**
	 * return errors
	 *
	 * @return MessageBag
	 **/
	function getError()
	{
		return $this->errors;
	}
	
	/**
	 * construct function, iniate error
	 *
	 */
	function __construct() 
	{
		parent::__construct();

		$this->errors = new MessageBag;
	}
}