<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use SoftDeletes;
    const DEFAULT_VALUE = 1000;

    protected $fillable = [
        'user_id',
        'value'
    ];

    protected $hidden = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
