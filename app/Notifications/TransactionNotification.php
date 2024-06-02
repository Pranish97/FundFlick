<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\User;

class TransactionNotification extends Notification
{
    use Queueable;

    protected $amount;
    protected $otherUser;
    protected $remarks;
    protected $type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($amount, User $otherUser, $remarks, $type)
    {
        $this->amount = $amount;
        $this->otherUser = $otherUser;
        $this->remarks = $remarks;
        $this->type = $type;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $message = (new MailMessage)
            ->line('A transaction has been completed.')
            ->line('Amount: ' . $this->amount)
            ->line('Remarks: ' . $this->remarks)
            ->line('User: ' . $this->otherUser->name);

        if ($this->type === 'debited') {
            $message->line('Your account has been debited.');
        } else {
            $message->line('Your account has been credited.');
        }

        return $message
            ->action('View Transactions', url('/notification'))
            ->line('Thank you for using our application!');
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
            'amount' => $this->amount,
            'other_user' => $this->otherUser->name,
            'remarks' => $this->remarks,
            'type' => $this->type,
        ];
    }
}
