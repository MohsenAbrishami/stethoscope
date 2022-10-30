# Stethoscope <img src="art/stethoscope.png" style="width:25px">

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mohsenabrishami/stethoscope.svg)](https://packagist.org/packages/mohsenabrishami/stethoscope)
[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/mohsenabrishami/stethoscope.svg)](https://packagist.org/packages/mohsenabrishami/stethoscope)
![GitHub Actions](https://github.com/mohsenabrishami/stethoscope/workflows/Tests/badge.svg)

## A stethoscope for listening to your Laravel app server heartbeat

This Laravel package allows you to monitor the infrastructure. You can check at any time what percentage of the processor and memory is used, How much hard drive space is empty, and sees the internet connection and web server status.

Once installed, monitoring your server is very easy. Just issue this artisan command:

``` bash
php artisan stethoscope:listen
```

But the work of this package didn't stop there. you can set thresholds for CPU and memory consumption. if CPU and memory consumption exceeds thresholds or hard disk free space is less than thresholds, then a log is created from details consumption. also, you can config this package so that if the deactivated web server or disconnected internet log is created. To start monitoring your server, just run this command:

``` bash
php artisan stethoscope:monitor
```

Do you need more options? you can make an issue or contributes to the package


## Installation and usage

This package requires PHP 8.0 and Laravel 8.0 or higher.
You can install the package via composer:

``` bash
composer require mohsenabrishami/stethoscope
```

and then run:

``` bash
php artisan vendor:publish --tag=stethoscope
```

## Credits

- [Mohsen Abrishami](https://github.com/mohsenabrishami)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
