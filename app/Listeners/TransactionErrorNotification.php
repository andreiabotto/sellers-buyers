<?php

namespace App\Listeners;

use App\Events\TransactionError;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TransactionErrorNotification
{
    public $tries = 3;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\TransactionError  $event
     * @return void
     */
    public function handle(TransactionError $event)
    {
        //
    }
}
