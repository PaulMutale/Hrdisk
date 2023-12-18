<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Auth;

class InviteEmployee extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $company_name,$message,$email,$password;
        
    public function __construct($company_name,$message,$email,$password)
    {
        $this->company_name = $company_name; 
        $this->message = $message; 
        $this->email = $email; 
        $this->password = $password; 
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
                   ->greeting($this->company_name)
                    ->line($this->message)
                    ->line('Please use the following credentials for login in: ') 
                    ->line('EMAIL: ' .$this->email) 
                    ->line('COMPANY ID: ' .Auth::user()->security_number)
                    ->line('PASSWORD: test1234')                    
                    ->action('Login', url('/login_view'))
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
