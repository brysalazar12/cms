<?php namespace Brysalazar12\Cms;

use Illuminate\Support\ServiceProvider;
use Event;
use Brysalazar12\Cms\Admin\Events\ReadModulesEvent;
use Brysalazar12\Cms\Admin\Contracts\Installable;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Filesystem\Filesystem;

/**
 * Description of CMSServiceProvider
 *
 * @author bryan
 */
class CMSServiceProvider extends ServiceProvider
{
	protected $files;
	public function boot()
	{
		if (! $this->app->routesAreCached()) {
			require __DIR__.'/Admin/routes.php';
		}
	}

	protected function registerPingpongLibraries()
	{
		$this->app->register(\Pingpong\Widget\WidgetServiceProvider::class);
		$this->app->register(\Pingpong\Menus\MenusServiceProvider::class);
		$this->app->booting(function () {
			$loader = AliasLoader::getInstance();
			$loader->alias('Menu', \Pingpong\Menus\MenuFacade::class);
		});
	}

	public function registerCMSCommand()
	{
		$this->commands('cms.install');
		$bind_method = method_exists($this->app, 'bindShared') ? 'bindShared' : 'singleton';

		$this->app->{$bind_method}('cms.install', function($app) {
			return new Core\Console\InstallCommand($this->files);
		});
	}

	public function register()
	{
		$this->files = new Filesystem();

		// register pingpong
		$this->registerPingpongLibraries();

		$this->app->register(\ArtemSchander\L5Modular\ModuleServiceProvider::class);

		$this->registerCMSCommand();

		// move Admin to app_path('Modules/Admin')

		// read all modules
//		$modules = require __DIR__ . '/modules.php';
//
//		foreach($modules as $module) {
//			$m = new $module($this->app);
//			if($m instanceof Installable) {
//				$m->init();
//			}
//		}
//
//		$readModulesEvent = event(new ReadModulesEvent($modules, $this->app));
//		dd($modules);
	}

}
