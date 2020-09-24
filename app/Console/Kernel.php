<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //
    }

    /**
     * Get the commands to add to the application.
     *
     * @return array
     */
    protected function getCommands()
    {
        if (config('app.env') !== 'production') {
            $this->commands[] = \AdamTyn\Lumen\Artisan\ServeCommand::class;
            $this->commands[] = \AdamTyn\Lumen\Artisan\JobMakeCommand::class;
            $this->commands[] = \AdamTyn\Lumen\Artisan\ModelMakeCommand::class;
            $this->commands[] = \AdamTyn\Lumen\Artisan\KeyGenerateCommand::class;
        }

        return parent::getCommands();
    }
}
