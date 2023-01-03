<?php

namespace MohsenAbrishami\Stethoscope\Listeners;

use Illuminate\Support\Facades\Mail;
use MohsenAbrishami\Stethoscope\Mail\LogReportMail;

class SendResourceLogNotification
{
    public function handle($resourceLogs)
    {
        Mail::to(config('stethoscope.notifications.mail.to'))->send(new LogReportMail($resourceLogs));
    }
}
