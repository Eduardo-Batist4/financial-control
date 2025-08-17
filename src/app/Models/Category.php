<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use softDeletes;

    protected $fillable = [
        'name',
<<<<<<< HEAD
=======
        'user_id',
>>>>>>> feat-crud-account-and-category
    ];

    protected $hidden = [];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
<<<<<<< HEAD
=======

    public function user()
    {
        return $this->belongsTo(User::class);
    }
>>>>>>> feat-crud-account-and-category
}
