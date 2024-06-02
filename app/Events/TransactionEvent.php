<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class TransactionEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $sender;
    public $recipient;
    public $amount;
    public $remarks;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $sender, User $recipient, $amount, $remarks)
    {
        $this->sender = $sender;
        $this->recipient = $recipient;
        $this->amount = $amount;
        $this->remarks = $remarks;
    }
}
