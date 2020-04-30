<?php

namespace Marqant\MarqantPayVoyager\Seeds;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataType;
use Illuminate\Support\Facades\DB;

/**
 * Class VoyagerProvidersDataTypesSeeder
 *
 * @package Marqant\MarqantPayVoyager\Seeds
 */
class VoyagerProvidersDataTypesSeeder extends Seeder
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
                'slug' => 'providers',
            ], [
                'name' => 'providers',
                'display_name_singular' => 'Provider',
                'display_name_plural' => 'Providers',
                'icon' => 'voyager-certificate',
                'model_name' => config('marqant-pay.provider_model'),
                'policy_name' => null,
                'controller' => '',
                'description' => '',
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => [],
            ]);
        });
    }
}
