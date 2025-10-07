<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Services\TransactionAnalysisService;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct(
        protected TransactionService $transactionService,
        protected TransactionAnalysisService $transactionAnalysisService
    ) {}

    public function index(Request $request)
    {
        $transaction = $this->transactionService->getAllTransactions($request->all());
        return TransactionResource::collection($transaction);
    }

    public function transactionStats(Request $request)
    {
        return $this->transactionAnalysisService->calculateMonthlyStats($request->all());
    }

    public function store(TransactionRequest $request)
    {
        $transaction = $this->transactionService->createTransaction($request->validated());
        return new TransactionResource($transaction);
    }

    public function update(int $id, TransactionRequest $request)
    {
        $transaction = $this->transactionService->updateTransaction($id, $request->validated());
        return new TransactionResource($transaction);
    }

    public function delete(int $id)
    {
        $this->transactionService->deleteTransaction($id);
        return response()->noContent();
    }
}
