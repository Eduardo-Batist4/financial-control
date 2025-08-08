<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Services\UserService;

class AuthController extends Controller
{

    public function __construct(protected UserService $userService){}

    public function index()
    {
        return $this->userService->all();
    }

    public function register(CreateUserRequest $request)
    {

    }
}
