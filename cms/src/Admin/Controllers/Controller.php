<?php namespace Brysalazar12\Cms\Admin\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Event;
use Brysalazar12\Cms\Admin\Events\ReadModulesEvent;

/**
 * This class should always extended if you want to extend
 * the functionality of admin
 *
 * @author Bryan Salazar
 */
abstract class Controller extends BaseController
{

	public function loadAllAdminModules()
	{
	}

	public function __construct()
	{
		// load all modules
	}
}
