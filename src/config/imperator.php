<?php

return [
    'url' => env('APP_URL', '/admin'). '/admin',
    'database'=>[
            'prefix'=>'news_',
        ],
    'tools' => [
            'perPage'=>15,
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

];
