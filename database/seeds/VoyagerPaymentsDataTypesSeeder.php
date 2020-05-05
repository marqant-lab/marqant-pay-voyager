<?php

namespace Marqant\MarqantPayVoyager\Seeds;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataType;
use Illuminate\Support\Facades\DB;

/**
 * Class VoyagerPaymentsDataTypesSeeder
 *
 * @package Marqant\MarqantPayVoyager\Seeds
 */
class VoyagerPaymentsDataTypesSeeder extends Seeder
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
                'slug' => 'payments',
            ], [
                'name' => 'payments',
                'display_name_singular' => 'Payment',
                'display_name_plural' => 'Payments',
                'icon' => 'voyager-wallet',
                'model_name' => config('marqant-pay.payment_model'),
                'policy_name' => null,
                'controller' => '',
                'description' => '',
                'generate_permissions' => 1,
                'server_side' => 0,
            ]);
        });
    }
}
