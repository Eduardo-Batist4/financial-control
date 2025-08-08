<?php

namespace App\Services;

use App\Http\Resources\AuthResource;
use App\Repositories\UserRepositories;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService
{
    public function __construct(protected UserRepositories $userRepositories){}

    public function register(array $request): array
    {
        $user = $this->userRepositories->create($request);

        $token = JWTAuth::fromUser($user);

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function login(array $request): array
    {
        if (!$token = JWTAuth::attempt($request)) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }

        return [
            'token' => $token
        ];
    }
}
