<?php

return [
    /**
     * Define storage driver for save logs
     */
    'storage' => [
        'driver' => 'local'
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
         * maximum RAM usage to percent
         */
        'ram' => 80
    ]
];
