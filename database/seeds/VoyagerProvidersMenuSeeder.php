<?php

namespace Marqant\MarqantPayVoyager\Seeds;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\MenuItem;
use Illuminate\Support\Facades\DB;

/**
 * Class VoyagerProvidersMenuSeeder
 *
 * @package Marqant\MarqantPayVoyager\Seeds
 */
class VoyagerProvidersMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     *
     * @throws \Throwable
     */
    public function run()
    {
        DB::transaction(function () {
            MenuItem::updateOrCreate([
                'menu_id' => 1,
                'title' => 'Providers',
            ], [
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-certificate',
                'color' => null,
                'parent_id' => null,
                'order' => 7,
                'route' => 'voyager.providers.index',
                'parameters' => null,
            ]);
        });
    }
}
