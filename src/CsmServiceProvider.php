<?php

	namespace Tuanbtre\Csm;
	
	use Illuminate\Support\Arr;
	use Illuminate\Support\ServiceProvider;
	class CsmServiceProvider extends ServiceProvider {
        public function boot()
        {
			$this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
			$this->publishes([__DIR__.'/Resources/Admin' => base_path('resources/views/Admin'), __DIR__.'/Resources/Public' => base_path('resources/views')], 'csm_view');
			$this->publishes([__DIR__.'/Resources/lang' => base_path('resources/lang')], 'csm_lang');
			$this->publishes([__DIR__.'/public' => public_path('vendor/csm'), __DIR__.'/compact-sylph-314402-56e30b928444.json'=>storage_path('app/public/compact-sylph-314402-56e30b928444.json'), __DIR__.'/images' => public_path('images')], 'csm_public');
			$this->publishes([__DIR__.'/Configs' => base_path('config')], 'csm_config');
		}
        public function register()
        {
			$this->commands(\Tuanbtre\Csm\Console\InstallCommand::class);
        }		
    }
