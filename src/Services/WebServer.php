<?php

namespace MohsenAbrishami\Stethoscope\Services;

class WebServer implements ServiceInterface
{
    public function monitor(string $log): string
    {
        $nginxStatus = exec('systemctl is-active nginx');

        $message = date('H:i:s') . " ===> nginx status: $nginxStatus \n";

        // print($message);

        if ($nginxStatus == 'inactive' && config('stethoscope.monitoring_enable.web_server'))
            $log .= $message;

        return $log;
    }
}
