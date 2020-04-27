# Voyager Setup for Marqant Pay


### Installation

Require the package through composer.
```
compsoer require marqant-lab/marqant-pay-voyager
```

Install Voyager
```
php artisan voyager:install
```
Assign any existing user as admin
```
php artisan voyager:admin your@email.com
```
Or create a new one
```
php artisan voyager:admin admin@admin.com --create
```
enter name and password

Go to your.awesome.site.com/admin

add seeders to DatabaseSeeder.php
