<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        Transaction::insert([
            [
                'name' => 'Supermercado',
                'category_id' => 1,
                'user_id' => 1,
                'type' => 'output',
                'amount' => 200,
                'date' => '2025-09-01',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'account_id' => 1,
            ],
            [
                'name' => 'Cinema',
                'category_id' => 2,
                'user_id' => 1,
                'type' => 'output',
                'amount' => 100,
                'date' => '2025-09-02',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'account_id' => 1,
            ],
            [
                'name' => 'Conta de Luz',
                'category_id' => 3,
                'user_id' => 1,
                'type' => 'output',
                'amount' => 150,
                'date' => '2025-09-03',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'account_id' => 1,
            ],
            [
                'name' => 'Academia',
                'category_id' => 4,
                'user_id' => 1,
                'type' => 'output',
                'amount' => 120,
                'date' => '2025-09-04',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'account_id' => 1,
            ],
            [
                'name' => 'Reserva Mensal',
                'category_id' => 6,
                'user_id' => 1,
                'type' => 'output',
                'amount' => 100,
                'date' => '2025-09-05',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'account_id' => 1,
            ],
            [
                'name' => 'Supermercado',
                'category_id' => 1,
                'user_id' => 2,
                'type' => 'output',
                'amount' => 250,
                'date' => '2025-09-01',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'account_id' => 2,
            ],
            [
                'name' => 'Show',
                'category_id' => 2,
                'user_id' => 2,
                'type' => 'output',
                'amount' => 180,
                'date' => '2025-09-02',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'account_id' => 2,
            ],
            [
                'name' => 'Conta de Água',
                'category_id' => 3,
                'user_id' => 2,
                'type' => 'output',
                'amount' => 120,
                'date' => '2025-09-03',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'account_id' => 2,
            ],
            [
                'name' => 'Curso Online',
                'category_id' => 4,
                'user_id' => 2,
                'type' => 'output',
                'amount' => 200,
                'date' => '2025-09-04',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'account_id' => 2,
            ],
            [
                'name' => 'Investimento Poupança',
                'category_id' => 5,
                'user_id' => 2,
                'type' => 'output',
                'amount' => 150,
                'date' => '2025-09-05',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'account_id' => 2,
            ],
        ]);
    }
}
