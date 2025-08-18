<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use softDeletes;

    protected $fillable = [
        'name',
        'category_id',
        'user_id',
        'type',
        'price',
        'description',
        'date'
    ];

    protected $hidden = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
