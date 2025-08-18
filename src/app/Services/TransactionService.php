<?php

namespace App\Services;

use App\Repositories\TransactionRepositories;
use Illuminate\Support\Facades\Auth;

class TransactionService
{
    public function __construct(protected TransactionRepositories $transactionRepositories) {}

    public function getAllTransactions()
    {
        return $this->transactionRepositories->getTransactions();
    }

    public function createTransaction(array $data)
    {
        $data['user_id'] = Auth::id();
        return $this->transactionRepositories->create($data);
    }

    public function updateTransaction(int $id, array $data)
    {
        $userId = Auth::id();
        $data['user_id'] = $userId;
        return $this->transactionRepositories->updateTransaction($id, $data, $userId);
    }

    public function deleteTransaction(int $id)
    {
        return $this->transactionRepositories->deleteTransaction($id, Auth::id());
    }
}
