# stethoscope

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mohsenabrishami/stethoscope.svg?style=flat-square)](https://packagist.org/packages/mohsenabrishami/stethoscope)
[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/mohsenabrishami/stethoscope.svg?style=flat-square)](https://packagist.org/packages/mohsenabrishami/stethoscope)

## A stethoscope for listening to your Laravel app server heartbeat

This Laravel package allows you to monitor the infrastructure. You can check at any time what percentage of the processor and memory is used. You can also see the status of the internet connection and the web server.

Once installed monitoring your server is very easy. Just issue this artisan command:

``` bash
php artisan stethoscope:listen
```

But the work of this package didn't stop there. you can set thresholds for CPU and memory. if CPU and memory consumption exceeds these thresholds, then a log is created from details consumption. also, you can  config this package so that if the  deactivated web server or disconnect internet log created.


## Installation and usage

This package requires PHP 8.0 and Laravel 8.0 or higher.
You can install the package via composer:

``` bash
composer require mohsenabrishami/stethoscope
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
