<?php

namespace Marqant\MarqantPayVoyager\Seeds;

use TCG\Voyager\Models\Role;
use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;
use Illuminate\Support\Facades\DB;

/**
 * Class VoyagerPaymentsPermissionsSeeder
 *
 * @package Marqant\MarqantPayVoyager\Seeds
 */
class VoyagerPaymentsPermissionsSeeder extends Seeder
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
            $browse = Permission::updateOrCreate([
                'key'        => 'browse_payments',
                'table_name' => 'payments',
            ]);

            $read = Permission::updateOrCreate([
                'key'        => 'read_payments',
                'table_name' => 'payments',
            ]);

            $edit = Permission::updateOrCreate([
                'key'        => 'edit_payments',
                'table_name' => 'payments',
            ]);

            $add = Permission::updateOrCreate([
                'key'        => 'add_payments',
                'table_name' => 'payments',
            ]);

            $delete = Permission::updateOrCreate([
                'key'        => 'delete_payments',
                'table_name' => 'payments',
            ]);

            // get admin role
            $role = Role::where('name', 'admin')
                ->first();
            /** @var Role $role attach permissions to admin */
            $role->permissions()
                ->attach($browse);
            $role->permissions()
                ->attach($read);
            $role->permissions()
                ->attach($edit);
            $role->permissions()
                ->attach($add);
            $role->permissions()
                ->attach($delete);
        });
    }
}
