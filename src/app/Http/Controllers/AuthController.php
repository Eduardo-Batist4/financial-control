<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\AuthResource;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService){}

    public function register(CreateUserRequest $request)
    {
        $data = $this->authService->register($request->validated());

        return (new AuthResource($data['user']))->additional(['token' => $data['token'], 'refresh_token' => $data['refresh_token']]);
    }

    public function login(LoginRequest $request)
    {
        return $this->authService->login($request->validated());
    }

    public function logout()
    {
        return $this->authService->logout();
    }

    public function refreshToken(Request $request) {
        $refreshTokenJti = $request->input('refresh_token');

        return $this->authService->refreshToken($refreshTokenJti);
    }
}
