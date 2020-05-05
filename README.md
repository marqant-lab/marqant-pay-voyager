# Voyager Setup for Marqant Pay


### Installation

Require the package through composer.
```
composer require marqant-lab/marqant-pay-voyager
```

Install Voyager (if you don't install it yet):
```
php artisan voyager:install
```
Assign any existing user as admin:
```
php artisan voyager:admin your@email.com
```
Or create a new one:
```
php artisan voyager:admin admin@admin.com --create
```
enter name and password

Go to your.awesome.site.com/admin  
to check it installation successfully.

Create seeders for billable model, for example App\\User

```
php artisan marqant-pay-voyager:seeders-billable App\\User
```
you will get this message:
```
  don't forget run '$ composer dump-autoload' before execute seeders.  
  execute seeder run: '$ php artisan db:seed --class="Marqant\MarqantPayVoyager\Seeds\VoyagerUsersDataTypesSeeder"'  
  execute seeder run: '$ php artisan db:seed --class="Marqant\MarqantPayVoyager\Seeds\VoyagerUsersDataRowsSeeder"'  
  execute seeder run: '$ php artisan db:seed --class="Marqant\MarqantPayVoyager\Seeds\VoyagerUsersMenuSeeder"'  
  execute seeder run: '$ php artisan db:seed --class="Marqant\MarqantPayVoyager\Seeds\VoyagerUsersPermissionsSeeder"'  
  run '$ composer dump-autoload' and execute seeders. Done! 👍  
```

you can execute them separately or add row to your DatabaseSeeder.php  
and just run (don't forget run '`$ composer dump-autoload`' before execute seeders):
```
$ php artisan db:seed
```
DatabaseSeeder.php
```php
use Marqant\MarqantPayVoyager\Seeds\VoyagerDatabaseSeeder;
...
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        ...
        $this->call(VoyagerDatabaseSeeder::class);
    }
}
```
and vendor/marqant-lab/marqant-pay-voyager/database/seeds/VoyagerDatabaseSeeder.php
```php
class VoyagerDatabaseSeeder extends Seeder
{
...
    public function run()
    {
        ...
        // Users
        $this->call(VoyagerUsersDataTypesSeeder::class);
        $this->call(VoyagerUsersDataRowsSeeder::class);
        $this->call(VoyagerUsersMenuSeeder::class);
        $this->call(VoyagerUsersPermissionsSeeder::class);
    }
}
```
not completed, to be continue...
