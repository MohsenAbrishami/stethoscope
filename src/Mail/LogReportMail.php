<?php

namespace MohsenAbrishami\Stethoscope\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LogReportMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $resourceLogs;

    public function __construct($resourceLogs)
    {
        $this->resourceLogs = $resourceLogs->resourceLogs;
    }

    public function build()
    {
        return $this->view('mohsenabrishami::emails.ResourceLog', [
            'resourceLogs' => $this->resourceLogs
        ]);
    }
}
