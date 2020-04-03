<?php

return [
    'title' => 'KK Imperator',
    'url' => env('APP_URL', '/admin'). '/admin',
    'database'=>[
        'prefix'=>'news_',
    ],
    'default-skin' => 'default',

    'tools' => [
            'perPage'=>15,
        ],

    'auth' => [
        'controller' => Chyis\Imperator\Controllers\LoginController::class,
        'guard' => 'admin',
        'guards' => [
            'admin' => [
                'driver'   => 'session',
                'provider' => 'admin',
            ],
        ],
        'providers' => [
            'admin' => [
                'driver' => 'eloquent',
                'model'  => Chyis\Imperator\Admin::class,
            ],
        ],
        // Add "remember me" to login form
        'remember' => true,

        // Redirect to the specified URI when user is not authorized.
        'redirect_to' => 'admin/login',

        // The URIs that should be excluded from authorization.
        'excepts' => [
            'admin/login',
            'admin/logout',
            '_handle_action_',
        ],
    ],
    'tables' => [
            'users'=>'users',
            'action_logs'=>'action_logs',
            'set_password'=>'users_password',
            'dictionary'=>'dictionary',
            'category'=>'category',
            'menu'=>'menu',
            'links'=>'links',
            'article'=>'article',
            'content'=>'article_content',
            'setting'=>'setting',
            'attachment'=>'attachment',
            'privilege'=>'privilege',
            'user_pri'=>'user_privilege',
            'roles'=>'roles',
            'user_role'=>'user_role',
            'role_pri'=>'role_privilege',
            'role_menu'=>'role_menu',
            'contacts'=>'contacts',
            'modules'=>'modules',
            'advertises'=>'advertises',
        ],
    'models'=>[
            'users'=>\Chyis\Imperator\Models\Users::class,

    ],
];
