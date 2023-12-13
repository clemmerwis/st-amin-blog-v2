<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryDetailResource;
use App\Http\Resources\CategoryIndexResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource records.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active = 'Categories';

        // get categories organized alphabetically and with parent categories first.
        $categories = Category::with('parent')->orderByRaw('ISNULL(parent_id) DESC, parent_id ASC, name ASC')->get();

        $categories = CategoryIndexResource::collection($categories);

        return view('dashboards.admin', [
            'active'     => $active,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {   
        $active = 'CategoryCreate';

        return view('dashboards.admin', [
            'active'   => $active
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category  $category
     * @return \Illuminate\View\View
     */
    public function edit(Category $category)
    {
        $active = 'CategoryEdit';

        $category = new CategoryDetailResource($category);

        return view('dashboards.admin', [
            'active'   => $active,
            'category' => $category,
        ]);
    }
}