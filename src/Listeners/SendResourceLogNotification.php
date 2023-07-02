<?php

namespace MohsenAbrishami\Stethoscope\Listeners;

class SendResourceLogNotification
{
    public function handle($resourceLogs)
    {
        if (! is_null(config('stethoscope.notifications.notifiable'))) {
            $notifiable = app(config('stethoscope.notifications.notifiable'));

            $notificationClass = $this->detemineNotificationClass();

            $notifiable->notify(
                new $notificationClass($resourceLogs)
            );
        }
    }

    private function detemineNotificationClass()
    {
        $notifications = config('stethoscope.notifications.notifications');

        return array_keys($notifications)[0];
    }
}
