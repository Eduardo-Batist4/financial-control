<?php

namespace App\Services;

use App\Repositories\AccountRepositories;
use App\Repositories\TransactionRepositories;
use App\Repositories\UserRepositories;
use Illuminate\Support\Facades\Auth;

class TransactionService
{
    public function __construct(
        protected TransactionRepositories $transactionRepositories,
        protected UserRepositories $userRepositories,
        protected AccountRepositories $accountRepositories,
    ) {}

    public function getAllTransactions()
    {
        return $this->transactionRepositories->getTransactions(Auth::id());
    }

    public function createTransaction(array $data)
    {
        $userId = Auth::id();
        $user = $this->userRepositories->getById($userId);
        $data['user_id'] = $userId;
        $data['account_id'] = $user->account->id;

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
        $userId = Auth::id();        
        $data['user_id'] = $userId;
        return $this->transactionRepositories->deleteTransaction($id, Auth::id());
    }
}
