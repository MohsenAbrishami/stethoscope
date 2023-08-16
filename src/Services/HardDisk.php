<?php

namespace MohsenAbrishami\Stethoscope\Services;

class HardDisk implements ServiceInterface
{
    public function check(): string
    {
        return (disk_free_space('/') / pow(1024, 3));
    }
}
