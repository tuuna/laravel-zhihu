<?php

namespace App\Notifications;

use App\Channels\SendEmailChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class NewUserFollowNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database',SendEmailChannel::class];
    }

    public function toSend($notifiable)
    {
        $data = [
            'url' => 'http://localhost:8000',
            'name' => Auth::guard('api')->user()->name
        ];
        Mail::send(
            "emails.notice",
            $data,
            function($message) use ($notifiable) {
                $message->to($notifiable->email)
                    ->subject(Auth::guard('api')->user()->name."用户关注了您");
            }
        );
    }

    public function toDatabase($notifiable)
    {
        return [
            'name' => Auth::guard('api')->user()->name,

        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    /*public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }*/

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
