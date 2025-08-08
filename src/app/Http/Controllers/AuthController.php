<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\AuthResource;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService){}

    public function register(CreateUserRequest $request)
    {
        $data = $this->authService->register($request->validated());

        return (new AuthResource($data['user']))->additional(['token' => $data['token']]);
    }

    public function login(LoginRequest $request)
    {
        return $this->authService->login($request->validated());
    }
}
