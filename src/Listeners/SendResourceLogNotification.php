<?php

namespace MohsenAbrishami\Stethoscope\Listeners;

use Illuminate\Support\Facades\Mail;
use MohsenAbrishami\Stethoscope\Mail\LogReportMail;

class SendResourceLogNotification
{
    public function handle($resourceLogs)
    {
        if(!is_null(config('stethoscope.notifications.mail.to')))
            Mail::to(config('stethoscope.notifications.mail.to'))->send(new LogReportMail($resourceLogs));
    }
}
