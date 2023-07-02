<?php

namespace MohsenAbrishami\Stethoscope\Services;

class WebServer implements ServiceInterface
{
    public $webServerStatuses = null;

    public function check(): string
    {
        if (config('stethoscope.web_server_name') == 'nginx') {
            $this->checkNginx();
        } elseif (config('stethoscope.web_server_name') == 'apache') {
            $this->checkApache();
        }

        return $this->webServerStatuses;
    }

    protected function checkNginx()
    {
        $this->webServerStatuses = exec('systemctl is-active nginx');
    }

    protected function checkApache()
    {
        $this->webServerStatuses = exec('systemctl is-active apache2.service');
    }
}
