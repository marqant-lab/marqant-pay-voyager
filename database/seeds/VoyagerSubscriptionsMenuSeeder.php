<?php

namespace Marqant\MarqantPayVoyager\Seeds;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\MenuItem;
use Illuminate\Support\Facades\DB;

/**
 * Class VoyagerSubscriptionsMenuSeeder
 *
 * @package Marqant\MarqantPayVoyager\Seeds
 */
class VoyagerSubscriptionsMenuSeeder extends Seeder
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
            // get subscriptions model
            $subscriptions_model = config('marqant-pay-subscriptions.subscription_model');
            if (empty($subscriptions_model)) return;

            // get subscriptions table
            $subscriptions_table = app($subscriptions_model)->getTable();
            $reflect = new \ReflectionClass($subscriptions_model);

            MenuItem::updateOrCreate([
                'menu_id' => 1,
                'title' => $reflect->getShortName() . 's',
            ], [
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-edit',
                'color' => null,
                'parent_id' => null,
                'order' => 7,
                'route' => 'voyager.' . $subscriptions_table . '.index',
                'parameters' => null,
            ]);
        });
    }
}
