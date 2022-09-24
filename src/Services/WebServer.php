<?php

namespace MohsenAbrishami\Stethoscope\Services;

namespace 

class WebServer
{
    public function index()
    {
        if (!config('stethoscope.monitoring_enable.web_server'))
            return null;

        $nginxStatus = exec('systemctl status nginx', $out, $exit_code);

        $message = date('H:i:s') . " ===> nginx status:  $nginxStatus \n";

        print($message);

        if (!$nginxStatus)
            $log .= $message;

        return $log;
    }
}
