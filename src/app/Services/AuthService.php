<?php

namespace App\Services;

use App\Http\Resources\AuthResource;
use App\Repositories\UserRepositories;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
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

    public function login(array $request)
    {
        if (!$token = JWTAuth::attempt($request)) {
            return response()->json([
                'message' => __('auth.failed'),
            ], 401);
        }

        return [
            'token' => $token
        ];
    }
}
