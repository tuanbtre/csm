<?php

	namespace Tuanbtre\Csm;
	
	use Illuminate\Support\Arr;
	use Illuminate\Support\ServiceProvider;
	use Tuanbtre\Csm\Component\Navbaradmin;
    class CsmServiceProvider extends ServiceProvider {
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
			$this->loadViewComponentsAs('csm', [Navbaradmin::class]);
		}
        public function register()
        {
			$this->loadAdminAuthConfig();
			$this->commands(\Tuanbtre\Csm\Console\InstallCommand::class);
			app('router')->aliasMiddleware('checkright', \Tuanbtre\Csm\Http\Middleware\CheckRight::class);	
			app('router')->aliasMiddleware('locale', \Tuanbtre\Csm\Http\Middleware\Locale::class);	
			app('router')->aliasMiddleware('mail', \Tuanbtre\Csm\Http\Middleware\SetMailSMTPConfig::class);	
        }		
		protected function loadAdminAuthConfig()
		{
			config(Arr::dot(config('admin.auth', []), 'auth.'));
			config(Arr::dot(config('admin.filesystems', []), 'filesystems.'));
		}
    }
