<?php

namespace App\Services;

use App\Http\Requests\CreateUserRequest;
use App\Repositories\UserRepositories;

class AuthService
{
    public function __construct(protected UserRepositories $userRepositories){}

    public function register(CreateUserRequest $request)
    {
        $user = $this->userRepositories->create($request->validated());

        if (!$user || !Hash::check($request->password, $user->password)) {
            return 'Fixing error response';
        }

        $toke = $user->createToken('token')->plainTextToken;

        return $user;
    }
}
