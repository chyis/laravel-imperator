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
        $this->loadViewsFrom(__DIR__.'/resources/views', 'Chyis/Imperator/Controllers');

        $this->loadRoutesFrom(__DIR__ . '/routes.php');
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
