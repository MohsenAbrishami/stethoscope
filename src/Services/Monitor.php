<?php

namespace MohsenAbrishami\Stethoscope\Services;

use Services\WebServer;

class Monitor
{
    public $webServer;
    
    public function __construct(WebServer $webServer)
    {
        $this->webServer = $webServer;
    }

    public function index()
    {
        $this->webServer->index();
    }
}
