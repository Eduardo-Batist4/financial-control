<?php

namespace App\Repositories;

use App\Filters\TransactionFilter;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB as FacadesDB;

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

    public function getTransactionsToStats(int $userId, ?array $filter = [])
    {
        $start = Carbon::now()->subMonth()->startOfMonth();
        $end = Carbon::now()->subMonth()->endOfMonth();
            
        $query = Transaction::select([
                'categories.id as category_id',
                'categories.name as category_name',
                FacadesDB::raw('SUM(transactions.amount) as total'),
            ])  
            ->join('categories', 'categories.id', '=', 'transactions.category_id')
            ->where('transactions.user_id', $userId)
            ->whereNull('transactions.deleted_at')
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('total');
            
            if (!empty($filter)) {
                $query = $this->filter->apply($query, $filter);
            } else {
                $query->whereBetween('transactions.date', [$start, $end]);
            } 

        $rows = $query->get();
    
        $total = $rows->sum('total');
        
        $stats = $rows->map(function ($row) use ($total){
            $row->percentage = $total > 0 ? round(($row->total / $total) * 100, 0) : 0;
            return $row;
        });
        
        return $stats;
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
