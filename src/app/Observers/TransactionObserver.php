<?php

namespace App\Observers;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionObserver
{
    public function created(Transaction $transaction): void
    {
        DB::transaction(function () use ($transaction) {
            $account = $transaction->account()->lockForUpdate()->first();

            if ($transaction->type === 'input') {
                $account->value += $transaction->price;
            } else {
                $account->value -= $transaction->price;
            }

            $account->save();
        });
    }

    public function updated(Transaction $transaction): void
    {
        //
    }

    public function deleted(Transaction $transaction): void
    {
        //
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
