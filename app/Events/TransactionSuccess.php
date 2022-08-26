<?php

namespace App\Events;

use App\Models\Transaction;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TransactionSuccess
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $senderName;
    public $receiverName;
    public $receiverAddress;
    public $value;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($senderName, $receiverName, $receiverAddress, $value)
    {
        $this->senderName = $senderName;
        $this->receiverName = $receiverName;
        $this->receiverAddress = $receiverAddress;
        $this->value = $value;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('transaction-success');
    }
}
