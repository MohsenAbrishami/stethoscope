<?php

namespace MohsenAbrishami\Stethoscope\Services;

class Cpu implements ServiceInterface
{
    public function check(): string
    {
        return exec(" grep 'cpu ' /proc/stat | awk '{print ($2+$4)*100/($2+$4+$5)}' ");
    }
}
