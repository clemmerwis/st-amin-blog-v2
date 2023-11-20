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

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'      => 'required',
            'slug'      => 'required',
            'parent_id' => 'nullable',
        ]);

        // limit payload
        $payload = $request->only([
            'name',
            'slug',
            'parent_id',
        ]);

        // Explicitly set parent_id to null if it's 'null'
        if ($request->input('parent_id') === 'null') {
            $payload['parent_id'] = null;
        }

        $category->update($payload);

        return response()->json(['ok' => true], 201);
    }
}
