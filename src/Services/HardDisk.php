<?php

namespace MohsenAbrishami\Stethoscope\Services;

class HardDisk implements ServiceInterface
{
    public function check(): string
    {
        return number_format((disk_free_space('/') / pow(1024, 3)), 2);
    }
}
