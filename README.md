<div align="center">
    <p>
        <h1><img src="art/stethoscope.png" style="width:30px"> Stethoscope<br/>For listening to your Laravel app server heartbeat</h1>
    </p>
</div>

<p align="center">
    <a href="#features">Features</a> |
    <a href="#installation">Installation</a> |
    <a href="#usage">Usage</a> |
    <a href="#configuration">Configuration</a> |
    <a href="#credits">Credits</a> |
    <a href="#license">License</a>
</p>

<p align="center">
    <a href="https://github.com/MohsenAbrishami/stethoscope">
        <img src="https://img.shields.io/packagist/v/mohsenabrishami/stethoscope" alt="Packagist">
    </a>
    <a href="https://github.com/MohsenAbrishami/stethoscope">
        <img src="https://img.shields.io/github/license/mohsenabrishami/stethoscope">
    </a>
    <a href="https://github.com/MohsenAbrishami/stethoscope">
        <img src="https://img.shields.io/packagist/dt/mohsenabrishami/stethoscope.svg">
    </a>
    <a href="https://github.com/MohsenAbrishami/stethoscope">
        <img src="https://github.com/mohsenabrishami/stethoscope/workflows/Tests/badge.svg">
    </a>
</p>

This Laravel package allows you to monitor the infrastructure.

With this package, You can check your server health at any time.

## Features

- monitor cpu usage percentage

- monitor memory usage percentage

- monitor hard disk free space

- check network connection status

- check nginx status

- record log when exceeding the consumption CPU, memory, and hard disk of thresholds 

- record log when the network connection fails or Nginx deactivated


Do you need more options? you can make an issue or contributes to the package

## Get Started

### Requirements
- **PHP 8.0+**
- **Laravel 8+**
- **Debian Based Linux**

### Installation

This package requires PHP 8.0 and Laravel 8.0 or higher.
You can install the package via composer:

``` bash
composer require mohsenabrishami/stethoscope
```

and then run:

``` bash
php artisan vendor:publish --tag=stethoscope
```

## Usage

Once installed, monitoring your server is very easy. Just issue this artisan command:

``` bash
php artisan stethoscope:listen
```

But the work of this package didn't stop there. you can set thresholds for CPU and memory consumption. if CPU and memory consumption exceeds thresholds or hard disk free space is less than thresholds, then a log is created from details consumption. also, you can config this package so that if the deactivated web server or disconnected internet log is created. To start monitoring your server, just run this command:

``` bash
php artisan stethoscope:monitor
```

## Configuration

## Credits

- [Mohsen Abrishami](https://github.com/mohsenabrishami)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
