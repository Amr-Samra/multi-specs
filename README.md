# multi-specs
package handle multi-options specs for products , services and more

## Install

Add to Composer

``` bash
"bdwey/specs": "dev-master",
```



Add to config/app providers
``` bash
Bdwey\Specs\SpecsServiceProvider::class,
```


## Usage

``` php
composer dump-autoload
php artisan migrate
php artisan vendor:publish --tag=specs.seeds
composer dump-autoload
php artisan db:seed  --class=SpecsSeeder
```