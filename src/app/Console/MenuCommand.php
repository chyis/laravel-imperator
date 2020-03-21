<?php

namespace Chyis\Imperator\Console;

use Encore\Admin\Facades\Admin;
use Illuminate\Console\Command;

class MenuCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'imperator:menu';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show the imperator menu';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $menu = Admin::menu();

        echo json_encode($menu, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), "\r\n";
    }
}
