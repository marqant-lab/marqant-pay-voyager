<?php

namespace Marqant\MarqantPayVoyager\Database\Seeds;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\MenuItem;
use Illuminate\Support\Facades\DB;

/**
 * Class VoyagerPaymentsMenuSeeder
 *
 * @package Marqant\MarqantPayVoyager\Seeds
 */
class VoyagerPaymentsMenuSeeder extends Seeder
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
                'title' => 'Payments',
            ], [
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-wallet',
                'color' => null,
                'parent_id' => null,
                'order' => 7,
                'route' => 'voyager.payments.index',
                'parameters' => null,
            ]);
        });
    }
}
