<?php

namespace MohsenAbrishami\Stethoscope\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LogReportNotification extends Notification
{

    public $resourceLogs;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($resourceLogs)
    {
        $this->resourceLogs = $resourceLogs->resourceLogs;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Notification Subject')
            ->view('email_template', [
                'resourceLogs' => $this->resourceLogs
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
