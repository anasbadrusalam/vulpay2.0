<?php

namespace App\Jobs;

use App\Models\Inbox;
use App\Models\Receiver;
use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Spatie\WebhookClient\Models\WebhookCall;
use Spatie\WebhookClient\Jobs\ProcessWebhookJob;

class TransactionWebhook extends ProcessWebhookJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        public WebhookCall $webhookCall
    ) {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = $this->webhookCall->payload['data'];
        $transaction = Transaction::whereStatus('menunggu')
            ->whereSender($data['sender'])
            ->whereTerminal($data['terminal'])
            ->first();

        if ($transaction && $data['amount'] >= 1000) {
            $transaction->update([
                'amount' => $data['amount'],
                'status' => 'sukses',
                'note' => 'disukseskan oleh sistem'
            ]);
        } else {
            $receiver = Receiver::whereTerminal($data['terminal'])->first();
            $inbox = Inbox::create([
                'terminal' => $data['terminal'],
                'code' => $receiver ? $receiver->code : null,
                'sender' => $data['sender'],
                'amount' => $data['amount'],
            ]);
        }
    }
}
