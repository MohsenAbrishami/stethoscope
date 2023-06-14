<?php

namespace MohsenAbrishami\Stethoscope\Listeners;

use Illuminate\Support\Facades\Notification;
use MohsenAbrishami\Stethoscope\Notifications\LogReportNotification;

class SendResourceLogNotification
{
    public function handle($resourceLogs)
    {
        if (!is_null(config('stethoscope.notifications.mail.to')))
            Notification::send(config('stethoscope.notifications.mail.to'), new LogReportNotification($resourceLogs));
    }
}
