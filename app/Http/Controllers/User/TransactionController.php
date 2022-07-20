<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransaction;
use App\Http\Resources\GeneralResource;
use App\Models\Provider;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransaction $request)
    {
        $provider = Provider::whereName($request->provider)->first();
        $receiver = $provider->getReceiver();

        $transaction = Transaction::create([
            'user_id' => $request->user()->id,
            'provider' => $provider->name,
            'sender' => $request->sender,
            'rate' => $request->rate ? $request->rate : $provider->rate,
            'receiver' => $receiver->number,
            'code' => $receiver->code,
            'terminal' => $receiver->terminal,
            'amount' => (int) $request->amount ? $request->amount : 0,
            'expired_at' => now()->addMinutes($provider->expired_time),
            'status' => 'menunggu'
        ]);

        return new GeneralResource($transaction);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return new GeneralResource($transaction);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        Gate::authorize('is-authorized', $transaction);

        if ($transaction->status == 'menunggu') {

            $transaction->update([
                'status' => 'dibatalkan',
                'note' => 'dibatalkan oleh user',
            ]);

            return (new GeneralResource($transaction->withoutRelations()))
                ->additional([
                    'status' => [
                        'type' => 'success',
                        'message' => 'Transaksi berhasil dibatalkan.'
                    ]
                ]);
        }

        return response()->json(['message' => 'Unauthorized.'], 401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
