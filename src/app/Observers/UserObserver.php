<?php

namespace App\Observers;

use App\Models\Account;
use App\Models\User;

class UserObserver
{
    public function created(User $user): void
    {
        Account::create([
           'user_id' => $user->id,
           'balance' => Account::DEFAULT_BALANCE,
        ]);
    }

    public function updated(User $user): void
    {
        //
    }

    public function deleted(User $user): void
    {
        $user->account()->delete();
    }

    public function restored(User $user): void
    {
        //
    }

    public function forceDeleted(User $user): void
    {
        //
    }
}
