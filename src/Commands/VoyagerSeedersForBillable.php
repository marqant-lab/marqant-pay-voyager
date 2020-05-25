<?php

namespace Marqant\MarqantPayVoyager\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Marqant\MarqantPay\Traits\Billable;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Finder\SplFileInfo;

/**
 * Class VoyagerSeedersForBillable
 *
 * @package Marqant\MarqantPayVoyager\Commands
 */
class VoyagerSeedersForBillable extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'marqant-pay-voyager:seeders-billable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create 4 Voyager seeders for billable model(s) from marqant-pay.billables config.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('  don\'t forget run \'$ composer dump-autoload\' before execute seeders.');

        // get all billable models from config
        $billables = collect(config('marqant-pay.billables'));

        $billables->each(function ($model_name) {
            $Billable = $this->getBillableModel($model_name);
            if (is_null($Billable)) {
                return;
            }

            $this->makeSeedersForBillable($Billable);
        });

        $this->info('  run \'$ composer dump-autoload\' and execute seeders. Done! 👍');
    }

    /**
     * Get billable argument from input and resolve it to a model with the Billable trait attached.
     *
     * @param string $model_name
     *
     * @return Model|null
     */
    private function getBillableModel(string $model_name)
    {
        $Billable = app($model_name);

        $can_continue = $this->checkIfModelIsBillable($Billable);
        if ($can_continue === false) {
            return null;
        }

        return $Billable;
    }

    /**
     * Ensure, that the given model actually uses the Billable trait.
     * If it doesn't, print out an error message and exit the command.
     *
     * @param Model $Billable
     *
     * @return bool
     */
    private function checkIfModelIsBillable(Model $Billable): bool
    {
        $traits = class_uses($Billable);

        if (!collect($traits)->contains(Billable::class)) {
            $this->alert('The given model '. get_class($Billable) . ' is not a Billable.');

            return false;
        }

        return true;
    }

    /**
     * @param Model $Billable
     *
     * @throws \ReflectionException
     */
    private function makeSeedersForBillable(Model $Billable): void
    {
        $table = $this->getTableFromBillable($Billable);

        $this->makeDataTypesSeeder($Billable, $table);

        $this->makeDataRowsSeeder($table);

        $this->makeMenuSeeder($table);

        $this->makePermissionsSeeder($table);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $Billable
     *
     * @return string
     */
    private function getTableFromBillable(Model $Billable): string
    {
        return $Billable->getTable();
    }

    /**
     * Create DataTypes seeder
     *
     * @param Model  $Billable
     * @param string $table
     *
     * @throws \ReflectionException
     */
    private function makeDataTypesSeeder(Model $Billable, string $table): void
    {
        $stub_path = $this->getStubPath('data_type_seeder.stub');

        $stub = $this->getStub($stub_path);

        $class_name = $this->getSeederClassName($table, 'DataTypes');

        $this->line("  execute seeder run: '$ php artisan db:seed --class=\"{$class_name}\"'");

        $path = base_path('database/seeds/');

        // no need to create seeder if it is already exists
        $can_continue = $this->preventDuplicates($path, $class_name);
        if ($can_continue === false) {
            return;
        }

        $this->replaceClassName($stub, $class_name);

        $this->replaceTableName($stub, $table);

        $this->replaceSingularName($stub, $Billable);

        $this->replacePluralName($stub, $table);

        $this->replaceBillableClassName($stub, $Billable);

        $this->saveSeeder($stub, $class_name);
    }

    /**
     * Create DataRows seeder
     *
     * @param string $table
     */
    private function makeDataRowsSeeder(string $table): void
    {
        $stub_path = $this->getStubPath('data_row_seeder.stub');

        $stub = $this->getStub($stub_path);

        $class_name = $this->getSeederClassName($table, 'DataRows');

        $this->line("  execute seeder run: '$ php artisan db:seed --class=\"{$class_name}\"'");

        $path = base_path('database/seeds/');

        $can_continue = $this->preventDuplicates($path, $class_name);
        if ($can_continue === false) {
            return;
        }

        $this->replaceClassName($stub, $class_name);

        $this->replaceTableName($stub, $table);

        $this->saveSeeder($stub, $class_name);
    }

    /**
     * Create Menu seeder
     *
     * @param string $table
     */
    private function makeMenuSeeder(string $table): void
    {
        $stub_path = $this->getStubPath('menu_seeder.stub');

        $stub = $this->getStub($stub_path);

        $class_name = $this->getSeederClassName($table, 'Menu');

        $this->line("  execute seeder run: '$ php artisan db:seed --class=\"{$class_name}\"'");

        $path = base_path('database/seeds/');

        $can_continue = $this->preventDuplicates($path, $class_name);
        if ($can_continue === false) {
            return;
        }

        $this->replaceClassName($stub, $class_name);

        $this->replaceTableName($stub, $table);

        $this->replacePluralName($stub, $table);

        $this->saveSeeder($stub, $class_name);
    }

    /**
     * Create Permissions seeder
     *
     * @param string $table
     */
    private function makePermissionsSeeder(string $table): void
    {
        $stub_path = $this->getStubPath('permissions_seeder.stub');

        $stub = $this->getStub($stub_path);

        $class_name = $this->getSeederClassName($table, 'Permissions');

        $this->line("  execute seeder run: '$ php artisan db:seed --class=\"{$class_name}\"'");

        $path = base_path('database/seeds/');

        $can_continue = $this->preventDuplicates($path, $class_name);
        if ($can_continue === false) {
            return;
        }

        $this->replaceClassName($stub, $class_name);

        $this->replaceTableName($stub, $table);

        $this->saveSeeder($stub, $class_name);
    }

    /**
     * @param string $file_name
     *
     * @return string
     */
    private function getStubPath(string $file_name): string
    {
        $stub_path = base_path('vendor/marqant-lab/marqant-pay-voyager/stubs/' . $file_name);

        return $stub_path;
    }

    /**
     * Returns the blueprint for the migration about to be created.
     *
     * @param string $stub_path
     *
     * @return string
     */
    private function getStub(string $stub_path): string
    {
        return file_get_contents($stub_path);
    }

    /**
     * @param string $stub
     * @param string $class_name
     *
     * @return string
     */
    private function replaceClassName(string &$stub, string $class_name): string
    {
        $stub = str_replace('{{CLASS_NAME}}', $class_name, $stub);

        return $stub;
    }

    /**
     * @param string $stub
     * @param string $table
     *
     * @return string
     */
    private function replaceTableName(string &$stub, string $table): string
    {
        $stub = str_replace('{{TABLE_NAME}}', $table, $stub);

        return $stub;
    }

    /**
     * @param string $stub
     * @param Model  $Billable
     *
     * @return mixed|string
     * @throws \ReflectionException
     */
    private function replaceSingularName(string &$stub, Model $Billable): string
    {
        $reflect = new \ReflectionClass($Billable);
        $stub = str_replace('{{S_TABLE_NAME}}', $reflect->getShortName(), $stub);

        return $stub;
    }

    /**
     * @param string $stub
     * @param string $table
     *
     * @return string
     */
    private function replacePluralName(string &$stub, string $table): string
    {
        // table => Table
        $table = ucfirst($table);
        $stub = str_replace('{{U_TABLE_NAME}}', $table, $stub);

        return $stub;
    }

    /**
     * @param string $stub
     * @param Model  $Billable
     *
     * @return mixed|string
     */
    private function replaceBillableClassName(string &$stub, Model $Billable): string
    {
        $stub = str_replace('{{BILLABLE_MODEL}}', get_class($Billable), $stub);

        return $stub;
    }

    /**
     * @param string $stub
     * @param string $class_name
     *
     * @return void
     */
    private function saveSeeder(string $stub, string $class_name): void
    {
        $file_name = $this->getSeederFileName($class_name);

        $path = base_path('database/seeds/');

        $can_continue = $this->preventDuplicates($path, $class_name);
        if ($can_continue === false) {
            return;
        }

        File::put($path . '/' . $file_name, $stub);
    }

    /**
     * @param string $class_name
     *
     * @return string
     */
    private function getSeederFileName(string $class_name): string
    {
        return "{$class_name}.php";
    }

    /**
     * @param string $table
     * @param string $type
     *
     * @return string
     */
    private function getSeederClassName(string $table, string $type): string
    {
        // table => Table
        $class = ucfirst($table);

        return "Voyager{$class}{$type}Seeder";
    }

    /**
     * Check if migration already exists
     *
     * @param string $path
     * @param string $class_name
     *
     * @return bool - true if can continue, false if find migration
     */
    private function preventDuplicates(string $path, string $class_name): bool
    {
        $file = $this->getSeederFileName($class_name);

        $files = collect(File::files($path))
            ->map(function (SplFileInfo $file) {
                return $file->getFilename();
            });

        if ($files->contains($file)) {
            $this->alert("Seeder for Voyager BREAD '{$class_name}' already exists.");

            return false;
        }

        return true;
    }

}
