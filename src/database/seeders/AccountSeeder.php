<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    public function run(): void
    {
        Account::create([
            'user_id' => 1,
            'balance' => Account::DEFAULT_BALANCE,
            'current_balance' => Account::DEFAULT_BALANCE,
        ]);
    }
}
