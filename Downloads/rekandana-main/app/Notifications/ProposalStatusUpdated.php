<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProposalStatusUpdated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $status, string $proposalTitle)
    {
        $this->status = $status;
        $this->proposalTitle = $proposalTitle;
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
        $subject = "Status Proposal Kamu Telah Diperbarui";
        $greeting = "Halo, " . $notifiable->name . "!";
        $line = "Kabar baik! Proposal kamu yang berjudul **\"" . $this->proposalTitle . "\"** telah **" . $this->status . "**. ";

        if ($this->status === 'ditolak') {
            $line = "Ada pembaruan untuk proposal kamu yang berjudul **\"" . $this->proposalTitle . "\"**. Statusnya saat ini adalah **" . $this->status . "**. Silakan cek dashboard untuk detail lebih lanjut.";
        }

        return (new MailMessage)
                    ->subject($subject)
                    ->greeting($greeting)
                    ->line($line)
                    ->action('Lihat Dashboard', url('/dashboard'))
                    ->line('Terima kasih telah menggunakan platform kami!');
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
