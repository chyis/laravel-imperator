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

    }


    public static  function username()
    {
        return 'user_name';
    }

}