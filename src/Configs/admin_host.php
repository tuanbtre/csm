<?php

return [

    'route' => [

        'prefix' => env('ADMIN_ROUTE_PREFIX', 'admin'),

        'namespace' => 'App\\Admin\\Controllers',

        'middleware' => ['web', 'admin'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin install directory
    |--------------------------------------------------------------------------
    |
    | The installation directory of the controller and routing configuration
    | files of the administration page. The default is `app/Admin`, which must
    | be set before running `artisan admin::install` to take effect.
    |
    */
    'adminpath' => app_path('Http/Controllers/Admin'),
	'modelpath' => app_path('Models'),

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin html title
    |--------------------------------------------------------------------------
    |
    | Html title for all pages.
    |
    */
    'title' => 'Admin',

    /*
    |--------------------------------------------------------------------------
    | Access via `https`
    |--------------------------------------------------------------------------
    |
    | If your page is going to be accessed via https, set it to `true`.
    |
    */    
    'lang' => env('APP_LANG_ADMIN', 2),
	/*
    |--------------------------------------------------------------------------
    | Laravel-admin auth setting
    |--------------------------------------------------------------------------
    |
    | Authentication settings for all admin pages. Include an authentication
    | guard and a user provider setting of authentication driver.
    |
    | You can specify a controller for `login` `logout` and other auth routes.
    |
    */
    'auth' => [

        'guards' => [
            'admin' => [
                'driver'   => 'session',
                'provider' => 'users',
            ],
        ],

        'providers' => [
            'users' => [
                'driver' => 'eloquent',
                'model'  => App\Models\User::class,
            ],
        ],

        // Add "remember me" to login form
        'remember' => true,

        // Redirect to the specified URI when user is not authorized.
        'redirect_to' => 'admin/login',

        // The URIs that should be excluded from authorization.
        'excepts' => [
            'auth/login',
            'auth/logout',
            '_handle_action_',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin upload setting
    |--------------------------------------------------------------------------
    |
    | File system configuration for form upload files and images, including
    | disk and upload path.
    |
    */
	'filesystems' =>[
		'default' => env('FILESYSTEM_DRIVER', 'images'),
		'disks' => [

			'public' => [
				'driver' => 'local',
				'root' => realpath(base_path().'/../public_html/storage'),
				'url' => env('APP_URL').'/storage',
				'visibility' => 'public',
			],

			'rootxml' => [
				'driver' => 'local',
				'root' => realpath(base_path().'/../public_html'),
				'url' => env('APP_URL'),
				'visibility' => 'public',
			],

			'images' => [
				'driver' => 'local',
				'root' => realpath(base_path().'/../public_html/images'),
				'url' => env('APP_URL').'/images',
				'visibility' => 'public',
			]        
		]
	]    
];
