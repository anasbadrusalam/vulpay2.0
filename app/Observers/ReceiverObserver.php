<?php

namespace App\Observers;

use App\Models\Receiver;

class ReceiverObserver
{
    /**
     * Handle the Receiver "created" event.
     *
     * @param  \App\Models\Receiver  $receiver
     * @return void
     */
    public function created(Receiver $receiver)
    {
        //
    }

    /**
     * Handle the Receiver "updated" event.
     *
     * @param  \App\Models\Receiver  $receiver
     * @return void
     */
    public function updated(Receiver $receiver)
    {
        // if ($receiver->balance > $receiver->provider->max_balance) {
        //     # code...
        // }
    }

    /**
     * Handle the Receiver "deleted" event.
     *
     * @param  \App\Models\Receiver  $receiver
     * @return void
     */
    public function deleted(Receiver $receiver)
    {
        //
    }

    /**
     * Handle the Receiver "restored" event.
     *
     * @param  \App\Models\Receiver  $receiver
     * @return void
     */
    public function restored(Receiver $receiver)
    {
        //
    }

    /**
     * Handle the Receiver "force deleted" event.
     *
     * @param  \App\Models\Receiver  $receiver
     * @return void
     */
    public function forceDeleted(Receiver $receiver)
    {
        //
    }
}
