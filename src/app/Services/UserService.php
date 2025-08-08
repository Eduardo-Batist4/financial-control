<?php

namespace App\Services;

use App\Repositories\UserRepositories;

class UserService
{
    public function __construct(protected UserRepositories $userRepositories){}

    public function all()
    {
        return $this->userRepositories->all();
    }

    public function update(int $id, array $data)
    {
        return $this->userRepositories->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->userRepositories->delete($id);
    }
}
