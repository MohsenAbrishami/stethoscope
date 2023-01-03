<?php

namespace MohsenAbrishami\Stethoscope\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LogReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $resourceLog;

    public function __construct($resourceLog)
    {
        $this->resourceLog = $resourceLog;
    }

    public function build()
    {
        return $this->view('mohsenabrishami::emails.ResourceLog');
    }
}