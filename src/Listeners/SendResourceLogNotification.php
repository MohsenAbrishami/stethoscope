<?php

namespace MohsenAbrishami\Stethoscope\Listeners;

use Illuminate\Notifications\Messages\MailMessage;

class SendResourceLogNotification
{
    public function handle($resourceReports)
    {
        // (new MailMessage())
        //     ->from(config('stethoscope.notifications.mail.from.address'), config('stethoscope.notifications.mail.from.name'))
        //     ->subject(trans('backup::notifications.backup_successful_subject'))
        //     ->line('');
    }
}
