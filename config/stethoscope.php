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
        'storage' => true,
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
    | You may define minimum Storage space by GB.
    |
    */

    'thresholds' => [

        'cpu' => env('CPU_MONITOR_THRESHOLD', 90),

        'memory' => env('MEMORY_MONITOR_THRESHOLD', 80),

        'storage' => env('STORAGE_MONITOR_THRESHOLD', 10),

    ],

    /*
    |--------------------------------------------------------------------------
    | Network Monitor URL
    |--------------------------------------------------------------------------
    | Here you can define the multiple desired URL for network monitoring. 
    | If an address cannot be reached, it checks other addresses to make sure that the problem is with the server network
    |
    */

    'network_monitor_url' => env('NETWORK_MONITOR_URL', ['https://1.1.1.1', 'https://www.google.com']),

    /*
    |--------------------------------------------------------------------------
    | Log Record Driver
    |--------------------------------------------------------------------------
    | Set `database` for save logs in database and `file` for record logs in file
    |
    */

    'drivers' => [
        'log_record' => env('STETHOSCOPE_LOG_DRIVER', 'file'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Clean up resource logs
    |--------------------------------------------------------------------------
    | Here you define the number of days for which resource logs must be kept.
    | Older resource logs will be removed.
    |
    */
    'cleanup_resource_logs' => 7,

    /*
    |--------------------------------------------------------------------------
    | Notifications
    |--------------------------------------------------------------------------
    | You can get notified when specific events occur. you should set an email to get notifications here.
    | If you don't need to send an email notification, set null.
    |
    */
    'notifications' => [

        'notifications' => [
            \MohsenAbrishami\Stethoscope\Notifications\LogReportNotification::class => ['mail'],
        ],

        'notifiable' => \MohsenAbrishami\Stethoscope\Notifications\Notifiable::class,

        'mail' => [
            'to' => null,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Dashboard Configuration
    |--------------------------------------------------------------------------
    | Here, you can specify whether the monitoring panel is enabled and the key required to access it.
    | Also, you can customize the monitoring panel path.
    |
    */
    'monitoring_panel' => [
        'status' => false,
        'path' => 'monitoring-panel',
        'key' => env('MONITORING_PANEL_KEY'),
    ],
];
