<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailable;

class CreateRequestNotifications extends Notification
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $address = 'smelter@detiknetwork-salesproduct.com';
        $ccaddress = 'designer@detik.com';
        $bccaddress = '';
        $subject = 'Testing Announcement Incoming Request';
        $name = 'CMS Design Smelter';

        return (new MailMessage)
                    ->template('emails.template.IncomingRequest')
                    ->from($address, $name)
                    ->cc($ccaddress, $name)
                    //->bcc($address, $name)
                    ->replyTo($address, $name)
                    ->subject($subject)
                    //->with([ 'test_message' => $this->data['message'] ])
                    ->greeting('Hello Detikers!')
                    ->line('Testing')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
                    ;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}