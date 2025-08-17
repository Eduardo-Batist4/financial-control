<?php

namespace App\Services;

use App\Repositories\UserRepositories;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function __construct(protected UserRepositories $userRepositories){}

    public function getById()
    {
        return $this->userRepositories->getById(Auth::id());
    }

    public function all()
    {
        return $this->userRepositories->all();
    }

    public function update(array $data)
    {
        return $this->userRepositories->update(Auth::id(), $data);
    }

    public function delete()
    {
        return $this->userRepositories->delete(Auth::id());
    }
}
