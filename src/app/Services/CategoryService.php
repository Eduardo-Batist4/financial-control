<?php

namespace App\Services;

use App\Repositories\CategoryRepositories;
use Illuminate\Support\Facades\Auth;

class CategoryService
{
    public function __construct(protected CategoryRepositories $categoryRepositories) {}

    public function all()
    {
        return $this->categoryRepositories->all();
    }

    public function create(array $data)
    {
        $data['user_id'] = Auth::id();
        return $this->categoryRepositories->create($data);
    }

    public function update(int $id, array $data)
    {
        $userId = Auth::id();
        $data['user_id'] = $userId;
        return $this->categoryRepositories->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->categoryRepositories->deleteCategory($id, Auth::id());
    }
}
