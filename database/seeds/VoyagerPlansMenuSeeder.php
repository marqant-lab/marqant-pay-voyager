<?php

namespace Marqant\MarqantPayVoyager\Seeds;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\MenuItem;
use Illuminate\Support\Facades\DB;

/**
 * Class VoyagerPlansMenuSeeder
 *
 * @package Marqant\MarqantPayVoyager\Seeds
 */
class VoyagerPlansMenuSeeder extends Seeder
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
                'title' => 'Plans',
            ], [
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-params',
                'color' => null,
                'parent_id' => null,
                'order' => 7,
                'route' => 'voyager.plans.index',
                'parameters' => null,
            ]);
        });
    }
}
