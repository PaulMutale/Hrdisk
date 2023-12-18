<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InviteAgent extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $company_name,$message,$email,$password,$agent_code;
        
    public function __construct($company_name,$message,$email,$password,$agent_code)
    {
        $this->company_name = $company_name; 
        $this->message = $message; 
        $this->email = $email; 
        $this->password = $password; 
        $this->agent_code = $agent_code; 
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
        ->line('Please use the following credentials for Login In: ') 
        ->line('EMAIL: ' .$this->email) 
        ->line('AGENT ID: ' .$this->agent_code)
        ->line('PASSWORD: ' .$this->password)                    
        ->action('Login', url('/agents_login_view'))
        ->line('Thank you for signing up!');
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
