<?php

namespace App\Listeners;

use App\Events\TransactionEvent;
use App\Notifications\TransactionNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendTransactionNotification
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\TransactionEvent  $event
     * @return void
     */
    public function handle(TransactionEvent $event)
    {
        $event->sender->notify(new TransactionNotification($event->amount, $event->recipient, $event->remarks, 'debited'));

        $event->recipient->notify(new TransactionNotification($event->amount, $event->sender, $event->remarks, 'credited'));
    }
}
