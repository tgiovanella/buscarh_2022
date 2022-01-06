<?php

namespace App\Http\Controllers\Api;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subcategory;

class CategoryController extends Controller
{
    public function categories($id = null)
    {
        $categories = Category::select('id', 'name')

            ->when((isset($id) && !empty($id)), function ($q) use ($id) {
                return $q->where('id', '=', $id);
            })->get();

        return $categories;
    }

    public function subcategories($category_id)
    {
        $subcategories = Subcategory::select('id', 'name')

            ->when((isset($category_id) && !empty($category_id)), function ($q) use ($category_id) {
                return $q->where('category_id', '=', $category_id);
            })->get();

        return $subcategories;
    }
}
