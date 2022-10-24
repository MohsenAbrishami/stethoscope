<?php

namespace MohsenAbrishami\Stethoscope\Services;

class HardDisk implements ServiceInterface
{
    public function check(): string
    {
        return diskfreespace('/');
    }
}
