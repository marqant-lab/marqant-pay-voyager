<?php

namespace Marqant\MarqantPayVoyager\Database\Seeds;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;
use Illuminate\Support\Facades\DB;

class VoyagerProvidersDataRowsSeeder extends Seeder
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
            /** @var DataType $dataType get the data type */
            $dataType = DataType::where('slug', 'payments')->firstOrFail();

            // field id
            DataRow::updateOrCreate([
                'data_type_id' => $dataType->id,
                'field' => 'id',
            ], [
                'type' => 'hidden',
                'display_name' => 'ID',
                'required' => true,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => [],
                'order' => 1,
            ]);

            // field name
            DataRow::updateOrCreate([
                'data_type_id' => $dataType->id,
                'field' => 'name',
            ], [
                'type' => 'text',
                'display_name' => 'Name',
                'required' => true,
                'browse' => true,
                'read' => true,
                'edit' => true,
                'add' => true,
                'delete' => true,
                'details' => [],
                'order' => 2,
            ]);

            // field slug
            DataRow::updateOrCreate([
                'data_type_id' => $dataType->id,
                'field' => 'slug',
            ], [
                'type' => 'text',
                'display_name' => 'Slug',
                'required' => true,
                'browse' => false,
                'read' => true,
                'edit' => true,
                'add' => true,
                'delete' => true,
                'details' => [],
                'order' => 3,
            ]);

            // field created_at
            DataRow::updateOrCreate([
                'data_type_id' => $dataType->id,
                'field' => 'created_at',
            ], [
                'type' => 'timestamp',
                'display_name' => 'Created at',
                'required' => true,
                'browse' => false,
                'read' => true,
                'edit' => false,
                'add' => false,
                'delete' => 1,
                'details' => [
                    'format' => '%Y-%m-%d %H:%M',
                ],
                'order' => 4,
            ]);

            // field updated_at
            DataRow::updateOrCreate([
                'data_type_id' => $dataType->id,
                'field' => 'updated_at',
            ], [
                'type' => 'timestamp',
                'display_name' => 'Updated at',
                'required' => true,
                'browse' => false,
                'read' => true,
                'edit' => false,
                'add' => false,
                'delete' => true,
                'details' => [
                    'format' => '%Y-%m-%d %H:%M',
                ],
                'order' => 5,
            ]);
        });
    }
}
