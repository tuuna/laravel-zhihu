<?php
namespace App\Channels;

use Illuminate\Notifications\Notification;

class SendEmailChannel
{
    public function send($notifiable,Notification $notification)
    {
        $message = $notifiable->toSend($notification);
    }
}