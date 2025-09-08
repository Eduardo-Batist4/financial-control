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
            'current_balance' => 330, // Temporary, for development only
        ]);

        Account::create([
            'user_id' => 2,
            'balance' => Account::DEFAULT_BALANCE,
            'current_balance' => 100, // Temporary, for development only
        ]);
    }
}
