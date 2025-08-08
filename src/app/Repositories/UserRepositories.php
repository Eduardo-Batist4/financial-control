<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepositories;
use Illuminate\Database\Eloquent\Model;

class UserRepositories extends BaseRepositories
{
    protected Model $model;

    public function __construct()
    {
        $this->model = new User();
    }
}
