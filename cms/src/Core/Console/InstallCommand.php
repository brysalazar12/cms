<?php namespace Brysalazar12\Cms\Core\Console;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Database\Console\Migrations\MigrateCommand;

/**
 * Description of InstallCommand
 *
 * @author Bryan Salazar
 */
class InstallCommand extends GeneratorCommand
{
	protected $name = 'cms:install';

	protected $currentStub;

	protected function getStub()
	{
		return $this->currentStub;
	}

	public function fire()
	{
		// copy Admin module in app/Modules/Admin
		$this->files->copyDirectory(dirname(dirname(__DIR__)) . '/Admin', app_path('Modules/Admin'));
		$this->call('migrate', ['--path' => 'app/Modules/Admin/Database/Migrations']);
	}

	protected function getArguments()
	{
		return [];
	}
}
