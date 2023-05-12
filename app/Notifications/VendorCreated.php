<?php

namespace App\Notifications;

use App\Models\Vendor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VendorCreated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    public $vendor;
    public function __construct(Vendor $vendor)
    {
        $this->vendor = $vendor;
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

        // default

//        return (new MailMessage)
//                    ->line('The introduction to the notification.')
//                    ->action('Notification Action', url('/'))
//                    ->line('Thank you for using our application!');


        $subject = sprintf('%s: لقد تم انشاء حسابكم في موقع الامامي %s!', config('app.name'), 'Rabie');
        $greeting = sprintf('مرحبا %s!', $notifiable->name);

        return (new MailMessage)
            ->subject($subject)
            ->greeting($greeting)
            ->salutation('Yours Faithfully')
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/site'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //  to column that stored in DB
        ];
    }
}
