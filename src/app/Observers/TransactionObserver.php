<?php

namespace App\Observers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Log;

class TransactionObserver
{
    public function created(Transaction $transaction): void
    {
        Log::info('Transaction created.', [
            'transaction_id' => $transaction->id,
            'amount' => $transaction->amount,
            'type' => $transaction->type,
        ]);

        $transaction->account->recalculateBalance();
    }

    public function updated(Transaction $transaction): void
    { 
        Log::info('Transaction updated.', [
            'transaction_id' => $transaction->id,
            'amount' => $transaction->amount,
            'type' => $transaction->type,
        ]);

        $transaction->account->recalculateBalance();
    }

    public function deleted(Transaction $transaction): void
    { 
        Log::info('Transaction created.', [
            'transaction_id' => $transaction->id,
            'amount' => $transaction->amount,
            'type' => $transaction->type,
        ]);
        
        $transaction->account->recalculateBalance();
    }

    public function restored(Transaction $transaction): void
    {
        //
    }

    public function forceDeleted(Transaction $transaction): void
    {
        //
    }
}
