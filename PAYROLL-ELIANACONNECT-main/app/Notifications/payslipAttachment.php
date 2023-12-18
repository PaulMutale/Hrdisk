<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class payslipAttachment extends Notification
{
    use Queueable;
    public $pdf;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($pdf)
    {
        //
        $this->pdf = $pdf;
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
        ->greeting('PAYSIP')
        ->line('Please find the attached file.')
        ->attach($this->pdf,[
            'mime' => 'application/pdf',
        ])
       ->action('Employee Portal ', url('/login_view'))
       ->line('Thank you for your service!');
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
