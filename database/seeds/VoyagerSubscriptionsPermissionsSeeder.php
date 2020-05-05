<?php

namespace Marqant\MarqantPayVoyager\Seeds;

use TCG\Voyager\Models\Role;
use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;
use Illuminate\Support\Facades\DB;

class VoyagerSubscriptionsPermissionsSeeder extends Seeder
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

            $browse = Permission::updateOrCreate([
                'key'        => 'browse_' . $subscriptions_table,
                'table_name' => $subscriptions_table,
            ]);

            $read = Permission::updateOrCreate([
                'key'        => 'read_' . $subscriptions_table,
                'table_name' => $subscriptions_table,
            ]);

            $edit = Permission::updateOrCreate([
                'key'        => 'edit_' . $subscriptions_table,
                'table_name' => $subscriptions_table,
            ]);

            $add = Permission::updateOrCreate([
                'key'        => 'add_' . $subscriptions_table,
                'table_name' => $subscriptions_table,
            ]);

            $delete = Permission::updateOrCreate([
                'key'        => 'delete_' . $subscriptions_table,
                'table_name' => $subscriptions_table,
            ]);

            // get admin role
            $role = Role::where('name', 'admin')
                ->first();
            /** @var Role $role attach permissions to admin */
            $role->permissions()
                ->syncWithoutDetaching($browse->id);
            $role->permissions()
                ->syncWithoutDetaching($read->id);
            $role->permissions()
                ->syncWithoutDetaching($edit->id);
            $role->permissions()
                ->syncWithoutDetaching($add->id);
            $role->permissions()
                ->syncWithoutDetaching($delete->id);
        });
    }
}
