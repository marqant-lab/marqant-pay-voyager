<?php

namespace Marqant\MarqantPayVoyager\Seeds;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataType;
use Illuminate\Support\Facades\DB;

/**
 * Class VoyagerPlansDataTypesSeeder
 *
 * @package Marqant\MarqantPayVoyager\Seeds
 */
class VoyagerPlansDataTypesSeeder extends Seeder
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
            DataType::updateOrCreate([
                'slug' => 'plans',
            ], [
                'name' => 'plans',
                'display_name_singular' => 'Plan',
                'display_name_plural' => 'Plans',
                'icon' => 'voyager-params',
                'model_name' => config('marqant-pay-subscriptions.plan_model'),
                'policy_name' => null,
                'controller' => '',
                'description' => '',
                'generate_permissions' => 1,
                'server_side' => 0,
            ]);
        });
    }
}
