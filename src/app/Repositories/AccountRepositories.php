<?php


namespace App\Repositories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Model;

class AccountRepositories extends BaseRepositories
{
    protected Model $model;

    public function __construct()
    {
        $this->model = new Account();
    }
}
