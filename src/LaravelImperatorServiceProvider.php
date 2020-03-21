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

    ];


    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'Imperator');

        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->publishes([
                __DIR__.'/views' => base_path('resources/views/vendor/imperator'),  // 发布视图目录到resources 下
                __DIR__.'/config/imperator.php' => config_path('imperator.php'), // 发布配置文件到 laravel 的config 下
            ]);
//        if (file_exists($routes = admin_path('routes.php'))) {
//            $this->loadRoutesFrom($routes);
//        }
    }

    public function register()
    {
        $this->app->singleton('imperator', function () {
            return new Imperator;
        });

        $this->commands($this->commands);
    }
}
