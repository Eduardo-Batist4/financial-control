<?php

namespace App\Services;

use App\Repositories\TransactionRepositories;
use Illuminate\Support\Facades\Auth;

class TransactionAnalysisService
{

    public function __construct(
        protected TransactionRepositories $transactionRepositories
    ) {}

    public function calculateMonthlyStats(?array $filter)
    {
        $transactions = $this->transactionRepositories->getTransactionsToStats(Auth::id(), $filter);
        
        return $transactions;
    }

} 
