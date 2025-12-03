<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Refresh_Token extends Model
{
    protected $table = 'refresh_token';
    protected $casts = ['jti' => 'string'];
    protected $fillable = [
        'user_id',
        'jti',
        'expires_at',
        'is_revoked',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function isExpired() {
        return Carbon::now()->isAfter($this->expires_at);
    }

    public function isInvalid() {
        return $this->is_revoked || $this->isExpired();
    }
}
