<?php

namespace MohsenAbrishami\Stethoscope\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TroubleOccurred
{
    use Dispatchable, SerializesModels;

    public $resourceLogs;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($resourceLogs)
    {
        $this->resourceLogs = $resourceLogs;
    }
}
