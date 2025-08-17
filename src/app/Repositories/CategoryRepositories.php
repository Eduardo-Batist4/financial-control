<?php

namespace App\Repositories;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class CategoryRepositories extends BaseRepositories
{
    protected Model $model;

    public function __construct()
    {
        $this->model = new Category();
    }

    public function update(int $id, array $data)
    {
        $category = Category::where('id', $id)
            ->where('user_id', $data['user_id'])
            ->first();
        $category->update($data);
        return $category;
    }

    public function deleteCategory(int $id, int $userId)
    {
        return Category::where('id', $id)
            ->where('user_id', $userId)
            ->delete();
    }
}
