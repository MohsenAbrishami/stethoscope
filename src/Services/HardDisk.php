<?php

namespace MohsenAbrishami\Stethoscope\Services;

class HardDisk implements ServiceInterface
{
    public function check(): string
    {
        return disk_free_space('/');
    }
}
