<?php

namespace MohsenAbrishami\Stethoscope\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use MohsenAbrishami\Stethoscope\Models\ResourceLog;

class LogReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $resourceLog;

    public function __construct(ResourceLog $resourceLog)
    {
        $this->resourceLog = $resourceLog;
    }

    public function build()
    {
        return $this->view('blogpackage::emails.ResourceLog');
    }
}