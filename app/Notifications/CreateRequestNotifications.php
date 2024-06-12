<?php

namespace App\Notifications;

use App\Models\Result;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Filament\Resources\RequestDesignResource\Pages\CreateRequestDesign;

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
        $ccaddress = 'arez.atlantiz@gmail.com';
        $bccaddress = '';
        $subject = 'Testing Announcement Incoming Request';
        $name = 'CMS Design Smelter';

        $user = Auth::user()->name;
        $email = Result::all()->last()->email;
        $brand = Result::all()->last()->brand;
        $brief = Result::all()->last()->brief;
        $form = Result::all()->last()->pilih_form;
        $tipe = Result::all()->last()->tipe;
        //$senderemail = record('email');
        //$result = $this->fill();

        return (new MailMessage)
                    ->from($address, $name)
                    ->cc($ccaddress, $name)
                    //->bcc($address, $name)
                    ->replyTo($address, $name)
                    ->subject($subject)
                    ->greeting('Hello!')
                    ->line("Ada request dibuat oleh {$user} dengan detail sebagai berikut,")
                    ->line("Email: {$email}")
                    ->line("Brand: {$brand}")
                    ->line("Form: {$form}")
                    ->line("Tipe: {$tipe}")
                    ->line("{$brief}")
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
                    //->with([ 'test_message' => $this->data['message'] ]);       
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
