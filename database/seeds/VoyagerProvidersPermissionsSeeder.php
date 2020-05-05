<?php

namespace Marqant\MarqantPayVoyager\Seeds;

use TCG\Voyager\Models\Role;
use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;
use Illuminate\Support\Facades\DB;

/**
 * Class VoyagerProvidersPermissionsSeeder
 *
 * @package Marqant\MarqantPayVoyager\Seeds
 */
class VoyagerProvidersPermissionsSeeder extends Seeder
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
                'key'        => 'browse_providers',
                'table_name' => 'providers',
            ]);

            $read = Permission::updateOrCreate([
                'key'        => 'read_providers',
                'table_name' => 'providers',
            ]);

            $edit = Permission::updateOrCreate([
                'key'        => 'edit_providers',
                'table_name' => 'providers',
            ]);

            $add = Permission::updateOrCreate([
                'key'        => 'add_providers',
                'table_name' => 'providers',
            ]);

            $delete = Permission::updateOrCreate([
                'key'        => 'delete_providers',
                'table_name' => 'providers',
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
