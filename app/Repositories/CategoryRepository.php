<?php

namespace App\Repositories;

use App\Models\Category;
Use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAllCategories()
    {
        return Category::latest()->get();
    }
}