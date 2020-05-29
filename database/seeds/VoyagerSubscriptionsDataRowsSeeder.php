<?php

namespace Marqant\MarqantPayVoyager\Seeds;

use Illuminate\Database\Seeder;
use Str;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;
use Illuminate\Support\Facades\DB;

/**
 * Class VoyagerSubscriptionsDataRowsSeeder
 *
 * @package Marqant\MarqantPayVoyager\Seeds
 */
class VoyagerSubscriptionsDataRowsSeeder extends Seeder
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

            /** @var DataType $dataType get the data type */
            $dataType = DataType::where('slug', $subscriptions_table)
                ->firstOrFail();

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

            // add Plan relation
            $Plan = app(config('marqant-pay-subscriptions.plan_model'));
            if (!empty($Plan)) {
                $plans_table = $Plan->getTable();

                $plan_singular = Str::singular($plans_table);
                // field plan_id
                DataRow::updateOrCreate([
                    'data_type_id' => $dataType->id,
                    'field' => $plan_singular . '_id',
                ], [
                    'type' => 'number',
                    'display_name' => ucfirst($plan_singular) . ' ID',
                    'required' => false,
                    'browse' => false,
                    'read' => true,
                    'edit' => true,
                    'add' => true,
                    'delete' => true,
                    'details' => [],
                    'order' => 11,
                ]);

                // relationship plan
                DataRow::updateOrCreate([
                    'data_type_id' => $dataType->id,
                    'field' => $subscriptions_table . '_belongsto_' . $plans_table . '_relationship',
                ], [
                    'type' => 'relationship',
                    'display_name' => ucfirst($plan_singular),
                    'required' => false,
                    'browse' => true,
                    'read' => true,
                    'edit' => true,
                    'add' => true,
                    'delete' => true,
                    'details' => [
                        'model' => get_class($Plan),
                        'table' => $plans_table,
                        'type' => 'belongsTo',
                        'column' => $plan_singular . '_id',
                        'key' => 'id',
                        'label' => 'name',
                        'pivot_table' => $plans_table,
                        'pivot' => "0",
                        'taggable' => null,
                    ],
                    'order' => 12,
                ]);
            }

            // field billable_id
            DataRow::updateOrCreate([
                'data_type_id' => $dataType->id,
                'field' => 'billable_id',
            ], [
                'type' => 'number',
                'display_name' => 'Billable ID',
                'required' => false,
                'browse' => true,
                'read' => true,
                'edit' => false,
                'add' => false,
                'delete' => false,
                'details' => [],
                'order' => 13,
            ]);

            // field billable_type
            DataRow::updateOrCreate([
                'data_type_id' => $dataType->id,
                'field' => 'billable_type',
            ], [
                'type' => 'text',
                'display_name' => 'Billable type',
                'required' => false,
                'browse' => true,
                'read' => true,
                'edit' => false,
                'add' => false,
                'delete' => false,
                'details' => [],
                'order' => 13,
            ]);

            // field created_at
            DataRow::updateOrCreate([
                'data_type_id' => $dataType->id,
                'field' => 'created_at',
            ], [
                'type' => 'timestamp',
                'display_name' => 'Created at',
                'required' => true,
                'browse' => true,
                'read' => true,
                'edit' => false,
                'add' => false,
                'delete' => 1,
                'details' => [
                    'format' => '%Y-%m-%d %H:%M',
                ],
                'order' => 14,
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
                'order' => 15,
            ]);
        });
    }
}
