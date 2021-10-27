<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin route settings
    |--------------------------------------------------------------------------
    |
    | The routing configuration of the admin page, including the path prefix,
    | the controller namespace, and the default middleware. If you want to
    | access through the root path, just set the prefix to empty string.
    |
    */
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
    | The installation directory of the controller | files of the administration page. The default is `Http/Controllers/Admin`, which must
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
				'root' => public_path('storage'),
				'url' => env('APP_URL').'/storage',
				'visibility' => 'public',
			],
			'rootxml' => [
				'driver' => 'local',
				'root' => public_path(),
				'url' => env('APP_URL'),
				'visibility' => 'public',
			],
			
			'images' => [
				'driver' => 'local',
				'root' => public_path('images'),
				'url' => env('APP_URL').'/images',
				'visibility' => 'public',
			],        
		]
	]
];
