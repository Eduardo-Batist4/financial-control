<?php

namespace App\Repositories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;

class TransactionRepositories extends BaseRepositories
{
    protected Model $model;

    public function __construct()
    {
        $this->model = new Transaction();
    }

    public function getTransactions()
    {
        return Transaction::with('category')->get();
    }

    public function updateTransaction(int $id, array $data, int $userId)
    {
        $transaction = Transaction::where('id', $id)
            ->where('user_id', $userId)
            ->first();
        $transaction->update($data);
        return $transaction;
    }

    public function deleteTransaction(int $id, int $userId)
    {
        return Transaction::where('id', $id)
            ->where('user_id', $userId)
            ->delete();
    }
}
