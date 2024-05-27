<?php

namespace MohsenAbrishami\Stethoscope\Listeners;

class SendResourceLogNotification
{
    public function handle($logs)
    {
        if (! is_null(config('stethoscope.notifications.notifiable'))) {
            $notifiable = app(config('stethoscope.notifications.notifiable'));

            $notificationClass = $this->detemineNotificationClass();

            $notifiable->notify(
                new $notificationClass($logs)
            );
        }
    }

    private function detemineNotificationClass()
    {
        $notifications = config('stethoscope.notifications.notifications');

        return array_keys($notifications)[0];
    }
}
