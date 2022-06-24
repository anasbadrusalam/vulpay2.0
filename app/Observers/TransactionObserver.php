<?php

namespace App\Observers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Log;
use Spatie\WebhookServer\WebhookCall;

class TransactionObserver
{
    /**
     * Handle the Transaction "created" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function created(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "updated" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function updated(Transaction $transaction)
    {
        $payload = $transaction;
        
        if ($transaction->isDirty('status')) {

            // if ($transaction->status == 'sukses') {
            //     $transaction->user->addBalance($transaction->balance);
            // }

            // if ($transaction->getOriginal('status') == 'sukses' && $transaction->status !== 'sukses') {
            //     $transaction->user->subBalance($transaction->balance);
            // }
            
            if ($transaction->user->webhook) {
                $webhook = $transaction->user->webhook;
                WebhookCall::create()
                    ->url($webhook->url)
                    ->payload(['data' => $payload
                    ])
                    ->useSecret($webhook->secret)
                    ->verifySsl(false)
                    ->throwExceptionOnFailure()
                    ->dispatch();
            }
        }
    }

    /**
     * Handle the Transaction "deleted" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function deleted(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "restored" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function restored(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "force deleted" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function forceDeleted(Transaction $transaction)
    {
        //
    }
}
