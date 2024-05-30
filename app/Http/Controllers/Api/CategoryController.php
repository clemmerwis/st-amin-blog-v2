<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Get all subcategories.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllSubCategories()
    {
        $subCategories = Category::whereNotNull('parent_id')->get();

        return response()->json($subCategories);
    }

    /**
     * Retrieve the subcategories for a given category name.
     *
     * @param  string  $category_name
     * @return \Illuminate\Http\Response
     */
    public function getChildCategories(string $category_name)
    {
        $subCategories = Category::where('name', $category_name)?->first()->subcats;

        return response()->json($subCategories ?? []);
    }

    public function getAllParentCategories()
    {
        $parentCategories = Category::whereNull('parent_id')->get();

        return response()->json($parentCategories);
    }
}