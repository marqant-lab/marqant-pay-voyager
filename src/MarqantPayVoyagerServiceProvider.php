<?php

namespace Marqant\MarqantPayVoyager;

use Illuminate\Support\ServiceProvider;
use Marqant\MarqantPayVoyager\Commands\VoyagerSeedersForBillable;

/**
 * Class MarqantPayVoyagerServiceProvider
 *
 * @package Marqant\MarqantPayVoyageroyager
 */
class MarqantPayVoyagerServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->setupCommands();
    }

    /**
     * Setup commands in boot method.
     *
     * @return void
     */
    private function setupCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                VoyagerSeedersForBillable::class,
            ]);
        }
    }

}
