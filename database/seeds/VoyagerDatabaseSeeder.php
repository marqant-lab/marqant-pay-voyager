<?php

namespace Marqant\MarqantPayVoyager\Seeds;

use Illuminate\Database\Seeder;
use TCG\Voyager\Traits\Seedable;

/**
 * Class VoyagerDatabaseSeeder
 *
 * @package Marqant\MarqantPayVoyager\Seeds
 */
class VoyagerDatabaseSeeder extends Seeder
{
    use Seedable;

    protected $seedersPath = __DIR__ . '/';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DataTypesTableSeeder::class);
        $this->call(DataRowsTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(MenuItemsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        // Payments
        $this->call(VoyagerPaymentsDataTypesSeeder::class);
        $this->call(VoyagerPaymentsDataRowsSeeder::class);
        $this->call(VoyagerPaymentsMenuSeeder::class);
        $this->call(VoyagerPaymentsPermissionsSeeder::class);
        // Providers
        $this->call(VoyagerProvidersDataTypesSeeder::class);
        $this->call(VoyagerProvidersDataRowsSeeder::class);
        $this->call(VoyagerProvidersMenuSeeder::class);
        $this->call(VoyagerProvidersPermissionsSeeder::class);
        // Plans
        $this->call(VoyagerPlansDataTypesSeeder::class);
        $this->call(VoyagerPlansDataRowsSeeder::class);
        $this->call(VoyagerPlansMenuSeeder::class);
        $this->call(VoyagerPlansPermissionsSeeder::class);
        // Subscriptions
        $this->call(VoyagerSubscriptionsDataTypesSeeder::class);
        $this->call(VoyagerSubscriptionsDataRowsSeeder::class);
        $this->call(VoyagerSubscriptionsMenuSeeder::class);
        $this->call(VoyagerSubscriptionsPermissionsSeeder::class);
    }
}
