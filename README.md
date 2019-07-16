[![Build Status](https://travis-ci.org/proxymakers/proxymakers-php.svg?branch=master)](https://travis-ci.org/proxymakers/proxymakers-php)
[![StyleCI](https://github.styleci.io/repos/197049199/shield?branch=master)](https://github.styleci.io/repos/197049199)
<a href="https://packagist.org/packages/proxymakers/proxymakers-php"><img src="https://poser.pugx.org/proxymakers/proxymakers-php/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/proxymakers/proxymakers-php"><img src="https://poser.pugx.org/proxymakers/proxymakers-php/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/proxymakers/proxymakers-php"><img src="https://poser.pugx.org/proxymakers/proxymakers-php/license.svg" alt="License"></a>

# proyxmakers-php
ProxyMakers PHP Library (with laravel support)

please read our [documentation](https://proxymakers.com/developers) for usage.

---

## Installation

The recommended way to install this library is through Composer:

`$ composer require proxymakers/proxymakers-php`

If you're not familiar with `composer` follow the installation instructions for
[Linux/Unix/Mac](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx) or
[Windows](https://getcomposer.org/doc/00-intro.md#installation-windows), and then read the
[basic usage introduction](https://getcomposer.org/doc/01-basic-usage.md).

### Laravel 5.5 and up

You don't have to do anything else, this package uses the Package Auto-Discovery feature, and should be available as soon as you install it via Composer.

### Laravel 5.4 or 5.3

Add the following Service Provider to your **config/app.php** providers array:

`ProxyMakers\API\ProxyMakersServiceProvider::class,`

### Publish Laravel Configuratino Files (All Versions)

`php artisan vendor:publish --provider="ProxyMakers\API\ProxyMakersServiceProvider"`

### Environment Variables

```
PROXYMAKERS_TOKEN=<insert_your_token_here>
```

## Standalone Usage

after installing with composer you can simply initiate a new instance of ProxyMakers class:


```php
$pm = new ProxyMakers\API\ProxyMakers($token);
// use the method you want, ex:
var_dump($pm->checkCredit()->getData());
```

## Laravel Usage

you can use dependency injection feature in any method of your controller or resolve it through laravel service container:

using dependency injection:
```php
Route::get('/', function (\ProxyMakers\API\ProxyMakers $pm) {
    dd($pm->checkCredit()->getData());
});
```

using service container:
```php
$pm = resolve('ProxyMakers\\API\\ProxyMakers');
dd($pm->checkCredit()->getData());
```

## Dependencies

The library uses [Guzzle](https://github.com/guzzle/guzzle) as its HTTP communication layer.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
