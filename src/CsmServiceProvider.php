<?php

	namespace Tuanbtre\Csm;
	
	use Illuminate\Console\Events\CommandFinished;
	use Illuminate\Support\Facades\Artisan;
	use Illuminate\Support\Facades\Event;
	use Illuminate\Support\Facades\Request;
	use Illuminate\Support\Str;
	use Symfony\Component\Console\Output\ConsoleOutput;
	use Illuminate\Support\ServiceProvider;
	use Tuanbtre\Csm\Component\Navbaradmin;
    class CsmServiceProvider extends ServiceProvider {
        protected $seeds_path = '/Database/Seeds';
		public function boot()
        {
			$this->loadRoutesFrom(__DIR__.'/Routers/AdminRoute.php');
			$this->loadRoutesFrom(__DIR__.'/Routers/public.php');
			$this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
			$this->loadViewsFrom(__DIR__.'/Resources/views', 'csm');
			$this->publishes([__DIR__.'/Resources/views' => base_path('resources/views/Admin')], 'csm_view');
			$this->publishes([__DIR__.'/Resources/lang' => base_path('resources/lang')], 'csm_lang');
			$this->publishes([__DIR__.'/public' => public_path('vendor/csm'), __DIR__.'/compact-sylph-314402-56e30b928444.json'=>storage_path('app/public/compact-sylph-314402-56e30b928444.json'), __DIR__.'/images' => public_path('images')], 'csm_public');
			$this->publishes([__DIR__.'/Configs' => base_path('config')], 'csm_config');
			$this->publishes([__DIR__.'/Models' => base_path('app/Models')], 'csm_model');
			$this->publishes([__DIR__.'/Http/Controllers' => base_path('app/Http/Controllers/Admin')], 'csm_controller');
			$this->loadViewComponentsAs('csm', [Navbaradmin::class]);
			if ($this->app->runningInConsole()) {
				if ($this->isConsoleCommandContains([ 'db:seed', '--seed' ], [ '--class', 'help', '-h' ])) {
					$this->addSeedsAfterConsoleCommandFinished();
				}
			}
        }
        public function register()
        {
			app('router')->aliasMiddleware('checkright', \Tuanbtre\Csm\Http\Middleware\CheckRight::class);	
			app('router')->aliasMiddleware('locale', \Tuanbtre\Csm\Http\Middleware\Locale::class);	
			app('router')->aliasMiddleware('mail', \Tuanbtre\Csm\Http\Middleware\SetMailSMTPConfig::class);	
        }
		protected function isConsoleCommandContains($contain_options, $exclude_options = null) : bool
		{
			$args = Request::server('argv', null);
			if (is_array($args)) {
				$command = implode(' ', $args);
				if (
					Str::contains($command, $contain_options) &&
					($exclude_options == null || !Str::contains($command, $exclude_options))
				) {
					return true;
				}
			}
			return false;
		}
		protected function addSeedsAfterConsoleCommandFinished()
		{
			Event::listen(CommandFinished::class, function(CommandFinished $event) {
				// Accept command in console only,
				// exclude all commands from Artisan::call() method.
				if ($event->output instanceof ConsoleOutput) {
					$this->addSeedsFrom(__DIR__ . $this->seeds_path);
				}
			});
		}
		protected function addSeedsFrom($seeds_path)
		{
			$file_names = glob( $seeds_path . '/*.php');
			foreach ($file_names as $filename)
			{
				$classes = $this->getClassesFromFile($filename);
				foreach ($classes as $class) {
					echo "\033[1;33mSeeding:\033[0m {$class}\n";
					$startTime = microtime(true);
					Artisan::call('db:seed', [ '--class' => $class, '--force' => '' ]);
					$runTime = round(microtime(true) - $startTime, 2);
					echo "\033[0;32mSeeded:\033[0m {$class} ({$runTime} seconds)\n";
				}
			}
		}
		private function getClassesFromFile(string $filename) : array
		{
			// Get namespace of class (if vary)
			$namespace = "";
			$lines = file($filename);
			$namespaceLines = preg_grep('/^namespace /', $lines);
			if (is_array($namespaceLines)) {
				$namespaceLine = array_shift($namespaceLines);
				$match = array();
				preg_match('/^namespace (.*);/', $namespaceLine, $match);
				$namespace = array_pop($match);
			}
			// Get name of all class has in the file.
			$classes = array();
			$php_code = file_get_contents($filename);
			$tokens = token_get_all($php_code);
			$count = count($tokens);
			for ($i = 2; $i < $count; $i++) {
				if ($tokens[$i - 2][0] == T_CLASS && $tokens[$i - 1][0] == T_WHITESPACE && $tokens[$i][0] == T_STRING) {
					$class_name = $tokens[$i][1];
					if ($namespace !== "") {
						$classes[] = $namespace . "\\$class_name";
					} else {
						$classes[] = $class_name;
					}
				}
			}
			return $classes;
		}
    }
