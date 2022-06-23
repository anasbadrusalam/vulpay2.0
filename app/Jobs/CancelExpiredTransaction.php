<?php

namespace App\Jobs;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CancelExpiredTransaction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $transactions = Transaction::whereStatus('menunggu')->get();

        foreach ($transactions as $transaction) {

            if ($transaction->expired_at && $transaction->expired_at->lt(now())) {
                $transaction->update([
                    'status' => 'dibatalkan',
                    'note' => 'dibatalkan oleh sistem'
                ]);
            }
        }
    }
}
