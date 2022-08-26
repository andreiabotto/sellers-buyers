<?php

namespace App\Listeners;

use App\Events\TransactionSuccess;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TransactionSucessNotification
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
     * @param  \App\Events\TransactionSuccess  $event
     * @return void
     */
    public function handle(TransactionSuccess $event)
    {
        //
    }
}
