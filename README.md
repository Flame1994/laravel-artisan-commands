## Laravel 5 Custom Artisan Commands

[![Latest Version on Packagist][ico-version]][link-packagist]
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
composer dum-autoload
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

Below you can find all the commands that you can use

```bash
php artisan make:service ExampleService
```

### License

The Laravel Artisan Commands is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)


[ico-version]: https://img.shields.io/packagist/v/barryvdh/laravel-ide-helper.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/barryvdh/laravel-ide-helper.svg?style=flat-square
[ico-stars]: https://img.shields.io/github/stars/Flame1994/laravel-artisan-commands.svg

[link-packagist]: https://packagist.org/packages/rhaarhoff/laravel-artisan-commands
[link-downloads]: https://packagist.org/packages/rhaarhoff/laravel-artisan-commands
[link-stars]: https://github.com/Flame1994/laravel-artisan-commands
