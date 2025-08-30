<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use SoftDeletes;
    const DEFAULT_BALANCE = 1000;

    protected $fillable = [
        'user_id',
        'balance',
        'current_balance',
    ];

    protected $hidden = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function recalculateBalance()
    {
        $inputs = $this->transactions()
            ->where('type', Transaction::TYPE_INPUT)
            ->sum('amount');
        $outputs = $this->transactions()
            ->where('type', Transaction::TYPE_OUTPUT)
            ->sum('amount');

        $this->current_balance = $this->balance + $inputs - $outputs;
        $this->updateQuietly();
    }
}
