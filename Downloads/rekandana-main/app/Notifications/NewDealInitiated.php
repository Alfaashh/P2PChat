<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewDealInitiated extends Notification
{
    use Queueable;

    protected $proposal;
    protected $sponsor;

    public function __construct($proposal, $sponsor)
    {
        $this->proposal = $proposal;
        $this->sponsor = $sponsor;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Deal Baru Dimulai untuk Proposal Anda')
                    ->greeting('Halo ' . $notifiable->name . '!')
                    ->line('Kabar baik! Sponsor "' . $this->sponsor->company_name . '" tertarik dengan proposal Anda: "' . $this->proposal->title . '"')
                    ->line('Mereka telah memulai deal dan akan segera menghubungi Anda.')
                    ->action('Lihat Proposal', url('/dashboard'))
                    ->line('Terima kasih telah menggunakan platform kami!');
    }
}