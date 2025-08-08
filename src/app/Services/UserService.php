<?php

namespace App\Services;

use App\Http\Requests\CreateUserRequest;
use App\Repositories\UserRepositories;

class UserService
{
    public function __construct(protected UserRepositories $userRepositories){}

    public function all()
    {
        return $this->userRepositories->all();
    }

}
