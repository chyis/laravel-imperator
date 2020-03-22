<?php

namespace Chyis\Imperator;

class Imperator {

    /**
     * The Laravel admin version.
     *
     * @var string
     */
    const VERSION = '0.1.0';
    const APPNAME = 'Laravel-Imperator';

    protected $moduleEnabled = [];

    public function printRunning()
    {
        echo self::getVersion().' is running ..........' . "\n";
    }

    /**
     * Returns the Name of Laravel-imperator.
     *
     * @return string The application name
     */
    public static function getAppName()
    {
        return self::APPNAME;
    }

    /**
     * Returns the version of Laravel-imperator.
     *
     * @return string The application version
     */
    public static function getVersion()
    {
        return self::VERSION;
    }

    /**
     * Returns the long version of Laravel-imperator.
     *
     * @return string The long application version
     */
    public static function getLongVersion()
    {
        return sprintf('Laravel-imperator <comment>version</comment> <info>%s</info>', self::VERSION);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        return $this->guard()->user();
    }

    /**
     * Attempt to get the guard from the local cache.
     *
     * @return \Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
     */
    public static function guard()
    {
        $guard = config('imperator.auth.guard') ?: 'admin';

        return Auth::guard($guard);
    }

    /**
     * Register the laravel-imperator built-in routes.
     *
     * @return void
     */
    public function routes()
    {
        $attributes = [
            'prefix'     => config('imperator.route.prefix'),
            'middleware' => config('imperator.route.middleware'),
        ];

        app('router')->group($attributes, function ($router) {

            $router->namespace('\Chyis\Imperator\Controllers')->group(function ($router) {
                /**
                 * laravel imperator built-in routes
                 * 内置路由不可删除
                 */
                $router->get('login', 'LoginController@index')->name('admin.login');
                $router->post('login', 'LoginController@signin')->name('admin.signin');
                //登出
                $router->get('logout', 'UserController@logout')->name('admin.logout');

                $router->get('/', 'IndexController@index')->name('admin.main');

                $router->get('profile', 'UserController@edit')->name('admin.profile');
                $router->post('profile', 'UserController@update')->name('admin.profile.save');
                //密码修改
                $router->get('password', 'UserController@password')->name('admin.password');
                $router->post('password', 'UserController@setPass')->name('admin.password.save');
                // Dictionary module function routes
                $router->resource('dictionary','DictionaryController', ['as'=>'admin']);
                // Menu module function routes
                $router->resource('menu', 'MenuController', ['as'=>'admin']);
                // Privilege module function routes
                $router->resource('role', 'RoleController', ['as'=>'admin']);
                $router->resource('privilege', 'PrivilegeController', ['as'=>'admin']);
                $router->resource('manager', 'ManagerController', ['as'=>'admin']);
                //系统管理设置
                $router->get('setting','SettingController@index')->name('admin.setting');
                $router->get('setting-system','SettingController@system')->name('admin.setting-system');
                $router->get('setting-upload','SettingController@upload')->name('admin.setting-upload');
                $router->post('setting-save','SettingController@store')->name('admin.setting-save');
                $router->put('setting-update','SettingController@update')->name('admin.setting-update');
                /**
                 * laravel imperator customizable function routes
                 * 用户定制路由开启与否取决于config
                 */
                // if config.cms was set enabled
                $router->resource('news','NewsController', ['as'=>'admin']);
                $router->resource('category','CategoryController', ['as'=>'admin']);
                $router->resource('advertise','AdvertiseController', ['as'=>'admin']);
                // if config.message-board was set enabled
                $router->get('contact', 'ContactController@index')->name('admin.contact.index');
                $router->get('contact/{id}', 'ContactController@show')->name('admin.contact.show');
                $router->delete('contact/{id}', 'ContactController@show')->name('admin.contact.destroy');
                $router->post('reply', 'ContactController@reply')->name('admin.contact.reply');
                //图片上传
                $router->get('upload','UploadController@upload')->name('admin.upload');
                $router->post('upload','UploadController@doupload')->name('admin.do-upload');

                //模板管理选择
                $router->resource('module', 'ModuleController', ['as'=>'admin']);
                $router->get('template', 'TemplateController@index')->name('admin.template');

                $router->resource('actionLogs', 'ActionLogController', ['only' => ['index', 'destroy']])->names('admin.logs');
            });
        });
    }


    public static  function username()
    {
        return 'user_name';
    }

}