# :package_description

[![Latest Version on Packagist](https://img.shields.io/packagist/v/apsg/wordpressor.svg?style=flat-square)](https://packagist.org/packages/apsg/wordpressor)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/apsg/wordpressor/run-tests?label=tests)](https://github.com/apsg/wordpressor/actions?query=workflow%3ATests+branch%3Amaster)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/apsg/wordpressor/Check%20&%20fix%20styling?label=code%20style)](https://github.com/apsg/wordpressor/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/apsg/wordpressor.svg?style=flat-square)](https://packagist.org/packages/apsg/wordpressor)

Simple Wordpress accessor for PHP/Laravel projects. Now one can use Wordpress as CMS for Laravel application.

## Installation

You can install the package via composer:

```bash
composer require apsg/wordpressor
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Apsg\Wordpressor\WordpressorServiceProvider" --tag="wordpressor-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --provider="Apsg\Wordpressor\WordpressorServiceProvider" --tag="wordpressor-config"
```

This is the contents of the published config file:

```php
return [
    'url'   => env('WORDPRESS_URL'),
    'cache' => true,
];
```

## Usage

```php
$posts = (new Wordpressor)
            ->posts()
            ->take(3)
            ->getTransformed();
            
 $image = (new Wordpressor())
            ->media()
            ->get($mediumId);           

```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Szymon Gackowski](https://github.com/apsg)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
