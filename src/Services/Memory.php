<?php

namespace MohsenAbrishami\Stethoscope\Services;

class Memory implements ServiceInterface
{
    public function check(): string
    {
        return number_format(exec(" free | grep Mem | awk '{print $3/$2 * 100.0}' "), 2);
    }
}
