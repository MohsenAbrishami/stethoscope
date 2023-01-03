<?php

namespace MohsenAbrishami\Stethoscope\Listeners;

use Illuminate\Support\Facades\Mail;
use MohsenAbrishami\Stethoscope\Mail\LogReportMail;

class SendResourceLogNotification
{
    public function handle($resourceReports)
    {
        Mail::to(config('stethoscope.notifications.mail.to'))->send(new LogReportMail($resourceReports));
    }
}
