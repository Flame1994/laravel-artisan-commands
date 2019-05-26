## Laravel 5 Custom Artisan Commands

[![Latest Stable Version][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![Total Stars][ico-stars]][link-stars]
[![Total Downloads][ico-downloads]][link-downloads]

### Description
This package provides some useful Artisan commands for generating services, repositories and more.

### Installation

Require this package with Composer using the following command:

```bash
composer require rhaarhoff/laravel-artisan-commands
```

After updating Composer, add the service provider to the `providers` array in `config/app.php`:

```php
Rhaarhoff\LaravelArtisanCommands\CommandServiceProvider::class
```

Run the `dump-autoload` command:
```bash
composer dump-autoload
```

In Laravel, instead of adding the service provider in the `config/app.php` file, you can add the following code to your `app/Providers/AppServiceProvider.php` file, within the `register()` method:

```php
public function register()
{
    if ($this->app->environment() !== 'production') {
        $this->app->register(\Rhaarhoff\LaravelArtisanCommands\CommandServiceProvider::class);
    }
    // ...
}
```

### Commands

Below you can find all the commands that you can use, including the parameters that you can specify.

```
COMMAND                     PARAMETER             DESCRIPTION
-----------------------------------------------------------------------------------------------------------------------
make:service <name>                               Generates a basic service class
make:service <name>         -m <model>            Generates a basic service class as well as a model
make:service <name>         -c                    Generates a service class with a constructor
make:service <name>         -y <repository>       Generates a service class as well as a repository
make:repository <name>                            Generates a basic repository class
make:repository <name>      -m <model>            Generates a repository class as well as a model
make:layer <name>                                 Generates only a model class if no parameters are specified
make:layer <name>           -c                    Generates a new controller class for the model
make:layer <name>           -s                    Generates a new service class for the model
make:layer <name>           -y                    Generates a new repository class for the model
make:layer <name>           -f                    Generates a new factory class for the model
make:layer <name>           -m                    Generates a new migration for the model
make:layer <name>           -p                    Indicates if the model should be a custom intermediate table model
make:layer <name>           -r                    Indicates if the generated controller should be a resource controller
make:layer <name>           -all                  Generates a migration, factory, resource controller, service
                                                  and repository for the model
```

### License

The Laravel Artisan Commands is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).


[ico-version]: https://poser.pugx.org/rhaarhoff/laravel-artisan-commands/v/stable
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://poser.pugx.org/rhaarhoff/laravel-artisan-commands/downloads
[ico-stars]: https://img.shields.io/github/stars/Flame1994/laravel-artisan-commands.svg

[link-packagist]: https://packagist.org/packages/rhaarhoff/laravel-artisan-commands
[link-downloads]: https://packagist.org/packages/rhaarhoff/laravel-artisan-commands
[link-stars]: https://github.com/Flame1994/laravel-artisan-commands
