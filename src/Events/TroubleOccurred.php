<?php

namespace MohsenAbrishami\Stethoscope\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TroubleOccurred
{
    use Dispatchable, SerializesModels;

    public $logs;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($logs)
    {
        $this->logs = $logs;
    }
}
