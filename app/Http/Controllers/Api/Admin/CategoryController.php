<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryIndexResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        // Option to paginate a specified number of rows
        $rowsPerPage = $request->query('limit', 10);

        return CategoryIndexResource::collection(
            Post::orderBy('id', 'desc')
                ->paginate(request('page') ? $rowsPerPage : 10000)
        );
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'parent_id' => 'nullable|integer|exists:categories,id'
        ]);
        
        $category = new Category($data);
        $category->save();
        
        // Return response with the ID of the newly created post
        return response()->json(['ok' => true, 'id' => $category->id], 201);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'      => 'required',
            'slug'      => 'required',
            'parent_id' => 'nullable',
        ]);

        // Explicitly set parent_id to null if it's 'null'
        if ($request->input('parent_id') === 'null') {
            $payload['parent_id'] = null;
        }

        // If the category is being converted from a parent (parent_id = null) to a child (parent_id != null), 
        // then first update its children
        if ($request->input('parent_id') !== null && $category->parent_id === null) {
            // Get all categories that have this category as their parent
            $childCategories = Category::where('parent_id', $category->id)->get();

            // Loop through and set their parent_id to null
            foreach ($childCategories as $childCategory) {
                $childCategory->parent_id = null;
                $childCategory->save();
            }
        }

        // limit payload
        $payload = $request->only([
            'name',
            'slug',
            'parent_id',
        ]);

        $category->update($payload);

        return response()->json(['ok' => true], 201);
    }
}