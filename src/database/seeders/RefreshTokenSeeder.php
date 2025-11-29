<?php

namespace Database\Seeders;

use App\Models\Refresh_Token;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class RefreshTokenSeeder extends Seeder
{
    public function run(): void
    {
        Refresh_Token::create([
            'user_id' => 1,
            'jti' => Str::uuid(),
            'expires_at' => Carbon::now()->addDays(7),
            'is_revoked' => false,
        ]);

        Refresh_Token::create([
            'user_id' => 2,
            'jti' => Str::uuid(),
            'expires_at' => Carbon::now()->addDays(7),
            'is_revoked' => false,
        ]);
    }
}
