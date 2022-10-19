<?php

return [

    /**
     * Define what needs to be monitored
     */
    'monitoring_enable' => [
        'cpu' => true,
        'memory' => true,
        'web_server' => true,
        'network' => true,
        'hard_disk' => true
    ],

    /**
     * Define storage driver and path for save log file
     */
    'storage' => [
        'driver' => 'local',
        'path' => 'stethoscope/'
    ],

    /**
     *  If resource consumption exceeds these thresholds, a log will be created
     */
    'thereshold' => [

        /**
         * maximum CPU usage to percent
         */
        'cpu' => 90,

        /**
         * maximum memory usage to percent
         */
        'memory' => 80,

        /**
         * minimum hard disk space to byte
         */
        'hard_disk' => 5368709
    ],

    /**
     * Here you can define the desired URL for network monitoring
     */
    'network_monitor_url' => 'https://www.google.com'
];
