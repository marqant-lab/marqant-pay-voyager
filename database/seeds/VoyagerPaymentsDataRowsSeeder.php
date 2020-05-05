<?php

namespace Marqant\MarqantPayVoyager\Seeds;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;
use Illuminate\Support\Facades\DB;

/**
 * Class VoyagerPaymentsDataRowsSeeder
 *
 * @package Marqant\MarqantPayVoyager\Seeds
 */
class VoyagerPaymentsDataRowsSeeder extends Seeder
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

            // field provider
            DataRow::updateOrCreate([
                'data_type_id' => $dataType->id,
                'field' => 'provider',
            ], [
                'type' => 'text',
                'display_name' => 'Provider',
                'required' => true,
                'browse' => true,
                'read' => true,
                'edit' => true,
                'add' => true,
                'delete' => true,
                'details' => [],
                'order' => 2,
            ]);

            // field amount
            DataRow::updateOrCreate([
                'data_type_id' => $dataType->id,
                'field' => 'amount',
            ], [
                'type' => 'number',
                'display_name' => 'Amount',
                'required' => true,
                'browse' => true,
                'read' => true,
                'edit' => true,
                'add' => true,
                'delete' => true,
                'details' => [],
                'order' => 3,
            ]);

            // field currency
            DataRow::updateOrCreate([
                'data_type_id' => $dataType->id,
                'field' => 'currency',
            ], [
                'type' => 'text',
                'display_name' => 'Currency',
                'required' => true,
                'browse' => true,
                'read' => true,
                'edit' => true,
                'add' => true,
                'delete' => true,
                'details' => [],
                'order' => 4,
            ]);

            // field status
            DataRow::updateOrCreate([
                'data_type_id' => $dataType->id,
                'field' => 'status',
            ], [
                'type' => 'text',
                'display_name' => 'status',
                'required' => true,
                'browse' => true,
                'read' => true,
                'edit' => true,
                'add' => true,
                'delete' => true,
                'details' => [],
                'order' => 5,
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
                'order' => 6,
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
                'order' => 7,
            ]);
        });
    }
}
