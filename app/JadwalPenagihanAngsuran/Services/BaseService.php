<?php 

namespace App\JadwalPenagihanAngsuran\Services;

use Illuminate\Support\MessageBag;

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
		$this->errors = new MessageBag;
	}
}