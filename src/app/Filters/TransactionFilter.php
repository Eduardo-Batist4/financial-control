<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class TransactionFilter
{
    public function apply(Builder $query, array $filters)
    {
        if (!empty($filters['search'])) {
            $term = $filters['search'];
            $query->where("name", "LIKE", "%{$term}%");
        }

        if (!empty($filters['start_date'])) {
            $query->where("date", ">=", $filters['start_date']);
        }

        if (!empty($filters['end_date'])) {
            $query->where("date", "<=", $filters['end_date']);
        }

        return $query;
    }
}