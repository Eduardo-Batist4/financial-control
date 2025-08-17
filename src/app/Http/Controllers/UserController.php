<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\AuthResource;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(protected UserService $userService){}

    public function all()
    {
        return $this->userService->all();
    }

    public function update(UpdateUserRequest $request)
    {
        $user = $this->userService->update($request->validated());
        return (new AuthResource($user))->response()->setStatusCode(200);
    }

    public function delete()
    {
        $this->userService->delete();
        return response()->noContent();
    }
}
