<?php

namespace App\Listeners;

use App\Events\TransactionSuccess;
use App\Managers\Interfaces\ISenderManager;
use App\Repository\Interfaces\IRepositoryFactory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class TransactionSucessNotification implements ShouldQueue
{
    public $tries = 3;
    private $senderMsg;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(ISenderManager $senderMsg)
    {
        $this->senderMsg = $senderMsg;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\TransactionSuccess  $event
     * @return void
     */
    public function handle(TransactionSuccess $event)
    {
        $message = 'You have received a new Payment of value: $' . $event->value.'! From: '. $event->senderName;
        $this->senderMsg->SendMessage($event->receiverAddress, $message);
        Log::info('TransactionController Received Event');
        Log::info($message);
    }
}
