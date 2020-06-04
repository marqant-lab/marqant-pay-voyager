<?php

namespace Marqant\MarqantPayVoyager\Seeds;

use TCG\Voyager\Models\Menu;
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
            /** @var Menu $Menu */
            $Menu = Menu::where('name', 'admin')
                ->firstOrFail();

            MenuItem::updateOrCreate([
                'menu_id' => $Menu->id,
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
