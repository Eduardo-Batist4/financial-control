<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use softDeletes;

    protected $fillable = [
        'name',
    ];

    protected $hidden = [];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
