<?php

namespace MohsenAbrishami\Stethoscope\Services;

class WebServer implements ServiceInterface
{
    public $webServerStatuses = null;

    public function check(): string
    {
        if (config('stethoscope.available_web_servers') == 'nginx')
            $this->checkNginx();
        elseif (config('stethoscope.available_web_servers') == 'apache')
            $this->checkApache();

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
