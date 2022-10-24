<?php

namespace MohsenAbrishami\Stethoscope\Services;

class WebServer implements ServiceInterface
{
    public function check(): string
    {
        return exec('systemctl is-active nginx');
    }
}
