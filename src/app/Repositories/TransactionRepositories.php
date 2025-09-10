<?php

namespace App\Repositories;

use App\Filters\TransactionFilter;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;

class TransactionRepositories extends BaseRepositories
{
    protected Model $model;
    protected TransactionFilter $filter;

    public function __construct()
    {
        $this->model = new Transaction();
        $this->filter = new TransactionFilter();
    }

    public function getTransactions(int $userId, ?array $filter = [])
    {
        $query = Transaction::with('category')
            ->where('user_id', $userId);

        if (isset($filter)) {
            $query = $this->filter->apply($query, $filter);
        }
    
        return $query->simplePaginate(10);
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
        $transaction = Transaction::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();
        
        $transaction->delete();
    }
}
