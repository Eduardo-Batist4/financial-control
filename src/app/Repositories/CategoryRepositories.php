<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class CategoryRepositories extends BaseRepositories
{
    protected Model $model;

    public function __construct()
    {
        $this->model = new Category();
    }

    public function allCategories(int $id)
    {
        return Category::where('user_id', $id)
            ->orWhere('user_id', 1)
            ->get();
    }

    public function updateCategory(int $id, array $data)
    {
        $category = Category::where('id', $id)
            ->where('user_id', $data['user_id'])
            ->firstOrFail();
            
        $category->update($data);

        return $category;
    }

    public function deleteCategory(int $id, int $userId)
    {
        $category = Category::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        $category->delete();
    }
}
