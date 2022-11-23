<?php

return [

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
    | Available Web servers
    |--------------------------------------------------------------------------
    | Here you can define what web server or web servers are available on your server.
    | set true if the web server is in use, otherwise false
    |
    */

    'available_web_servers' => [
        'nginx' => true,
        'apache2' => true
    ],

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

    'drivers' => [
        'log' => 'file'
    ]

];
