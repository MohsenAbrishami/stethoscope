<?php

namespace MohsenAbrishami\Stethoscope\Notifications;

use Illuminate\Notifications\Notifiable as NotifiableTrait;

class Notifiable
{
    use NotifiableTrait;

    public function routeNotificationForMail(): string|array
    {
        return config('stethoscope.notifications.mail.to');
    }

    public function getKey(): int
    {
        return 1;
    }
}
