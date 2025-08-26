<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    public function __construct(protected CategoryService $categoryService){}

    public function index()
    {
        $categories = $this->categoryService->all();

        return CategoryResource::collection($categories);
    }

    public function create(CategoryRequest $request)
    {
        $category = $this->categoryService->create($request->validated());

        return new CategoryResource($category);
    }

    public function update(int $id, CategoryRequest $request)
    {
        $category = $this->categoryService->update($id, $request->validated());
        return new CategoryResource($category);
    }

    public function delete(int $id)
    {
        $this->categoryService->delete($id);
        return response()->noContent();
    }
}
