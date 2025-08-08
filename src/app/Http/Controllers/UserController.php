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

    public function update(int $id, UpdateUserRequest $request)
    {
        $user = $this->userService->update($id, $request->validated());
        return (new AuthResource($user))->response()->setStatusCode(200);
    }

    public function delete(int $id)
    {
        $this->userService->delete($id);
        return response()->noContent();
    }
}
