<?php

namespace MohsenAbrishami\Stethoscope\Services;

interface ServiceInterface
{
    public function monitor(string $log) :string;
}