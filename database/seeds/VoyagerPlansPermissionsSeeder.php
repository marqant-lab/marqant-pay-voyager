<?php

namespace Marqant\MarqantPayVoyager\Seeds;

use TCG\Voyager\Models\Role;
use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;
use Illuminate\Support\Facades\DB;

/**
 * Class VoyagerPlansPermissionsSeeder
 *
 * @package Marqant\MarqantPayVoyager\Seeds
 */
class VoyagerPlansPermissionsSeeder extends Seeder
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
                'key'        => 'browse_plans',
                'table_name' => 'plans',
            ]);

            $read = Permission::updateOrCreate([
                'key'        => 'read_plans',
                'table_name' => 'plans',
            ]);

            $edit = Permission::updateOrCreate([
                'key'        => 'edit_plans',
                'table_name' => 'plans',
            ]);

            $add = Permission::updateOrCreate([
                'key'        => 'add_plans',
                'table_name' => 'plans',
            ]);

            $delete = Permission::updateOrCreate([
                'key'        => 'delete_plans',
                'table_name' => 'plans',
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
