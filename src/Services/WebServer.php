<?php

namespace MohsenAbrishami\Stethoscope\Services;

class WebServer implements ServiceInterface
{
    public $webServerStatuses = [];

    public function check(): array
    {
        if (config('stethoscope.installed_web_servers.nginx'))
            $this->checkNginx();

        if (config('stethoscope.installed_web_servers.apache2'))
            $this->checkApache();

        return $this->webServerStatuses;
    }

    protected function checkNginx()
    {
        array_push(
            $this->webServerStatuses,
            ['nginx' => exec('systemctl is-active nginx')]
        );
    }

    protected function checkApache()
    {
        array_push(
            $this->webServerStatuses,
            ['apache' => exec('systemctl is-active apache2.service')]
        );
    }
}
