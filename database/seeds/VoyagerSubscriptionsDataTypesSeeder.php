<?php

namespace Marqant\MarqantPayVoyager\Seeds;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataType;
use Illuminate\Support\Facades\DB;

/**
 * Class VoyagerSubscriptionsDataTypesSeeder
 *
 * @package Marqant\MarqantPayVoyager\Seeds
 */
class VoyagerSubscriptionsDataTypesSeeder extends Seeder
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

            DataType::updateOrCreate([
                'slug' => $subscriptions_table,
            ], [
                'name' => $subscriptions_table,
                'display_name_singular' => $reflect->getShortName(),
                'display_name_plural' => $reflect->getShortName() . 's',
                'icon' => 'voyager-edit',
                'model_name' => $subscriptions_model,
                'policy_name' => null,
                'controller' => '',
                'description' => '',
                'generate_permissions' => 1,
                'server_side' => 0,
            ]);
        });
    }
}
