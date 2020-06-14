<?php

namespace Chyis\Imperator;

use Illuminate\Support\ServiceProvider;

class LaravelImperatorServiceProvider extends ServiceProvider
{
    protected $commands = [
            Console\ImperatorCommand::class,
            Console\MakeCommand::class,
            Console\MenuCommand::class,
            Console\InstallCommand::class,
            Console\PublishCommand::class,
            Console\UninstallCommand::class,
            Console\ImportCommand::class,
            Console\CreateUserCommand::class,
            Console\ResetPasswordCommand::class,
            Console\ExtendCommand::class,
            Console\ExportSeedCommand::class,
            Console\FormCommand::class,
            Console\PrivilegeCommand::class,
            Console\ActionCommand::class,
        ];
    protected $middlewares = [
        'imperator.admin'       => Middleware\AdminMiddleware::class,
//        'imperator.auth'       => Mipackages/chyis/laravel-imperator/src/LaravelImperatorServiceProvider.php:34ddleware\Authenticate::class,
//        'imperator.pjax'       => Middleware\Pjax::class,
//        'imperator.log'        => Middleware\LogOperation::class,
//        'imperator.permission' => Middleware\Permission::class,
//        'imperator.bootstrap'  => Middleware\Bootstrap::class,
//        'imperator.session'    => Middleware\Session::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'admin' => [
            'imperator.admin',
        ],
    ];

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'Imperator');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->registerPublishing();
        view()->share('staticDir', '/vendor/laravel-imperator');
        view()->share('pageName', '');
        view()->share('siteName', '');
        view()->share('siteAuthor', '');
        view()->share('sideBar', []);
        $loginUser = new \stdClass();
        $loginUser->nick_name = '';
        view()->share('loginUser', $loginUser);

//        if (file_exists($routes = config_path('routes.php'))) {
//            $this->loadRoutesFrom($routes);
//        }
    }

    public function register()
    {
        $this->app->singleton('imperator', function () {
            return new Imperator;
        });

        $this->loadAdminAuthConfig();
        $this->registerRouteMiddleware();
        $this->registerPublishing();

        $this->commands($this->commands);
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    protected function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__.'/config' => config_path()], 'laravel-imperator-config');
            $this->publishes([__DIR__.'/resources/lang' => resource_path('lang')], 'laravel-imperator-lang');
            $this->publishes([__DIR__ . '/DataBase/migrations' => database_path('migrations')], 'laravel-imperator-migrations');
            $this->publishes([__DIR__.'/resources/assets' => public_path('vendor/laravel-imperator')], 'laravel-imperator-assets');
        }
    }

    /**
     * Force to set https scheme if https enabled.
     *
     * @return void
     */
    protected function ensureHttps()
    {
        if (config('imperator.https') || config('imperator.secure')) {
            url()->forceScheme('https');
            $this->app['request']->server->set('HTTPS', true);
        }
    }

    /**
     * Setup auth configuration.
     *
     * @return void
     */
    protected function loadAdminAuthConfig()
    {
        config(\Arr::dot(config('imperator.auth', []), 'auth.'));
//        config(array_dot(config('imperator.auth', []), 'auth.'));
    }


    /**
     * Register the route middleware.
     *
     * @return void
     */
    protected function registerRouteMiddleware()
    {
        // register route middleware.
        foreach ($this->middlewares as $key => $middleware) {
            app('router')->aliasMiddleware($key, $middleware);
        }

        // register middleware group.
        foreach ($this->middlewareGroups as $key => $middleware) {
            app('router')->middlewareGroup($key, $middleware);
        }
    }
}
