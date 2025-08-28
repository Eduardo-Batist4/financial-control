<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;
use App\Http\Resources\AccountResource;
use App\Repositories\AccountRepositories;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function __construct(protected AccountRepositories $accountRepositories){}

    public function get()
    {
        $account = $this->accountRepositories->getAccountById(Auth::id());
        return new AccountResource($account);
    }
    public function update(AccountRequest $request)
    {
        $account = $this->accountRepositories->update(Auth::id(), $request->validated());
        return new AccountResource($account);
    }
}
