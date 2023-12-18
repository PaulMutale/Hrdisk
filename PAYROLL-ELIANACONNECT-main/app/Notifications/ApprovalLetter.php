<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Auth;

class ApprovalLetter extends Notification
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
        ->greeting('Congratulations')
        ->line('Appointment Notice.')
        ->line('Congratulations you have been added to the company Master File at ' .Auth::user()->username)
         ->line('You can contact the Company Principal at ' .Auth::user()->phone .' or via email at '.Auth::user()->principle_email .' for further guidance.' )
         
         ->line('Congratulations!');
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
