<?php

namespace Chyis\Imperator;

class Table {

    /**
     * The Laravel admin version.
     *
     * @var string
     */
    const VERSION = '0.1.0';
    const APPNAME = 'Laravel-Imperator';

    protected $moduleEnabled = [];


    /**
     * Create a new grid instance.
     *
     * @param Eloquent $model
     * @param Closure  $builder
     */
    public function __construct(Eloquent $model, Closure $builder = null)
    {
        $this->model = new Model($model, $this);
        $this->keyName = $model->getKeyName();
        $this->builder = $builder;

        $this->initialize();

        $this->handleExportRequest();

        $this->callInitCallbacks();
    }

    /**
     * Initialize.
     */
    protected function initialize()
    {
        $this->tableID = uniqid('grid-table');

        $this->columns = Collection::make();
        $this->rows = Collection::make();

        $this->initTools()
            ->initFilter();
    }
    public function printRunning()
    {
        echo self::getVersion().' is running ..........' . "\n";
    }

    public function username()
    {
        return 'user_name';
    }

}