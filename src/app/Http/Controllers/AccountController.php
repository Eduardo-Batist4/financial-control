<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;
use App\Http\Resources\AccountResource;
use App\Repositories\AccountRepositories;

class AccountController extends Controller
{
    public function __construct(protected AccountRepositories $accountRepositories){}
    public function update(int $id, AccountRequest $request)
    {
        $account = $this->accountRepositories->getById($id);
        $this->authorize('update', $account);

        $account = $this->accountRepositories->update($id, $request->validated());

        return new AccountResource($account);
    }
}
