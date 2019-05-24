## Laravel 5 Custom Artisan Commands

[![Latest Stable Version][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![Total Stars][ico-stars]][link-stars]
[![Total Downloads][ico-downloads]][link-downloads]

### Description
This package was created with the goal of helping the developer generate
their required files easily, such as services, repositories and more.

### Installation

Require this package with composer using the following command:

```bash
composer require rhaarhoff/laravel-artisan-commands
```

After updating composer, add the service provider to the `providers` array in `config/app.php`

```php
Rhaarhoff\LaravelArtisanCommands\CommandServiceProvider::class,
```

Run dump-autoload
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
COMMAND                     PARAMETER               DESCRIPTION
------------------------------------------------------------------------------------------------------------------------------------------------
make:service <name>                                 Generates a basic service class
make:service <name>         -m <model>              Generates a basic service class as well as a model
make:service <name>         -c                      Generates a service class with a constructor
make:service <name>         -r <repository>         Generates a service class as well as a repository
make:repository <name>                              Generates a basic repository class
make:repository <name>      -m <model>              Generates a repository class as well as a model
```

### License

The Laravel Artisan Commands is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)


[ico-version]: https://poser.pugx.org/rhaarhoff/laravel-artisan-commands/v/stable
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://poser.pugx.org/rhaarhoff/laravel-artisan-commands/downloads
[ico-stars]: https://img.shields.io/github/stars/Flame1994/laravel-artisan-commands.svg

[link-packagist]: https://packagist.org/packages/rhaarhoff/laravel-artisan-commands
[link-downloads]: https://packagist.org/packages/rhaarhoff/laravel-artisan-commands
[link-stars]: https://github.com/Flame1994/laravel-artisan-commands
