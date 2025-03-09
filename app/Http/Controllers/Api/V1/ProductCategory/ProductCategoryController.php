<?php

namespace App\Http\Controllers\Api\V1\ProductCategory;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\Category\NotificationCollection;
use App\Http\Resources\Product\ProductCollection;
use App\Models\Category;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class ProductCategoryController extends Controller
{
    public function __invoke(Request $request): CategoryCollection
    {
        $categories = QueryBuilder::for(Category::class)
            ->allowedFilters(['name'])
            ->allowedSorts(['created_at'])
            ->latest()
            ->get();

        return new CategoryCollection($categories);
    }
}
