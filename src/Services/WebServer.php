<?php

namespace MohsenAbrishami\Stethoscope\Services;

class WebServer implements ServiceInterface
{
    public $webServerStatuses = [];

    public function check(): array
    {
        $this->checkNginx();

        $this->checkApache();

        return $this->webServerStatuses;
    }

    protected function checkNginx()
    {
        $this->webServerStatuses['nginx'] = config('stethoscope.installed_web_servers.nginx') ?
            exec('systemctl is-active nginx') : null;
    }

    protected function checkApache()
    {
        $this->webServerStatuses['apache'] = config('stethoscope.installed_web_servers.apache2') ?
            exec('systemctl is-active apache2.service') : null;
    }
}
