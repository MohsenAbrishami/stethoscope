<div align="center">
    <p>
        <h1><img src="art/stethoscope.png" style="width:30px"> Stethoscope <br/>For listening to your Laravel app server heartbeat</h1>
    </p>
</div>

<p align="center">
    <a href="#features">Features</a> |
    <a href="#installation">Installation</a> |
    <a href="#usage">Usage</a> |
    <a href="#configuration">Configuration</a> |
    <a href="#testing">Testing</a> |
    <a href="#changelog">Changelog</a> |
    <a href="#contributing">Contributing</a> |
    <a href="#credits">Credits</a> |
    <a href="#license">License</a>
</p>

<p align="center">
    <a href="https://packagist.org/packages/mohsenabrishami/stethoscope">
        <img src="https://img.shields.io/packagist/v/mohsenabrishami/stethoscope" alt="Packagist">
    </a>
    <a href="https://packagist.org/packages/mohsenabrishami/stethoscope">
        <img src="https://img.shields.io/github/license/mohsenabrishami/stethoscope" alt="license">
    </a>
    <a href="https://packagist.org/packages/mohsenabrishami/stethoscope">
        <img src="https://img.shields.io/packagist/dt/mohsenabrishami/stethoscope.svg" alt="downloads total">
    </a>
    <a href="https://packagist.org/packages/mohsenabrishami/stethoscope">
        <img src="https://github.com/mohsenabrishami/stethoscope/workflows/Tests/badge.svg" alt="tests">
    </a>
    <a href="https://scrutinizer-ci.com/g/MohsenAbrishami/stethoscope">
        <img src="https://img.shields.io/scrutinizer/g/MohsenAbrishami/stethoscope.svg" alt="tests">
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

Stethoscope allows you to record reports both in a file and in a database. 
If you set the database driver in the config file, you must run migrate command:

``` bash
php artisan migrate
```

## Usage

Once installed, monitoring your server is very easy. Just issue this artisan command:

``` bash
php artisan stethoscope:listen
```

But the work of this package didn't stop there. you can set thresholds for CPU, memory and hard disk consumption. if CPU and memory consumption exceeds thresholds or hard disk free space is less than thresholds, then a log is created from details consumption. also, you can config this package so that if the deactivated web server or disconnected internet log is created. To start monitoring your server, just run this command:

``` bash
php artisan stethoscope:monitor
```

You can monitor your server constantly with the run this command by a cron job.
You may want to be notified if there is a problem in the server. For this, it is enough to set your email admin in the config file.

## Configuration

You can easily customize this package in the config/stethoscope.php.

In this file, You can configure the following:

- resources that should be monitored.

- storage driver and path to saving log files.

- Thresholds Of resources.

- Custom network URL for network connection monitor.

- Set emails address to send notification emails.

See the configuration below:

```php
    /*
    |--------------------------------------------------------------------------
    | Monitorable Resources
    |--------------------------------------------------------------------------
    | Here you can Define which resources should be monitored.
    | Set true if you want a resource to be monitored, otherwise false.
    |
    */

    'monitorable_resources' => [
        'cpu' => true,
        'memory' => true,
        'hard_disk' => true,
        'network' => true,
        'web_server' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Web Server Name
    |--------------------------------------------------------------------------
    | Here you can define what web server installed on your server.
    | Set `nginx` or `apache`
    |
    */

    'web_server_name' => 'nginx',

    /*
    |--------------------------------------------------------------------------
    | Log File Storage
    |--------------------------------------------------------------------------
    | Define storage driver and path for save log file.
    |
    */

    'log_file_storage' => [
        'driver' => 'local',
        'path' => 'stethoscope/',
    ],

    /*
    |--------------------------------------------------------------------------
    | Thresholds
    |--------------------------------------------------------------------------
    | If resource consumption exceeds these thresholds, a log will be created.
    | You may define maximum CPU and memory usage by percent.
    | You may define minimum hard disk space by byte.
    */

    'thresholds' => [

        'cpu' => env('CPU_MONITOR_THRESHOLD', 90),

        'memory' => env('MEMORY_MONITOR_THRESHOLD', 80),

        'hard_disk' => env('HARD_DISK_MONITOR_THRESHOLD', 5368709),

    ],

    /*
    |--------------------------------------------------------------------------
    | Network Monitor URL
    |--------------------------------------------------------------------------
    | Here you can define the desired URL for network monitoring.
    |
    */

    'network_monitor_url' => env('NETWORK_MONITOR_URL', 'https://www.google.com'),

    /*
    |--------------------------------------------------------------------------
    | Log Record Driver
    |--------------------------------------------------------------------------
    | Set `database` for save logs in database and `file` for record logs in file
    |
    */

    'drivers' => [
        'log_record' => env('STETHOSCOPE_LOG_DRIVER'  ,'file')
    ]

    /*
    |
    | You can get notified when specific events occur. you should set an email to get notifications here.
    |
    */
    'notifications' => [
        'mail' => [
            'to' => '',
        ],
    ],
```

## Testing
Run the tests with:

```php
composer test
```
## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Mohsen Abrishami](https://github.com/mohsenabrishami)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
