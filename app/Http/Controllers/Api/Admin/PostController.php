<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostIndexResource;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index(Request $request)
    {
        // Option to paginate a specified number of rows
        $rowsPerPage = $request->query('limit', 10);

        return PostIndexResource::collection(
            Post::orderBy('id', 'desc')
                            ->paginate(request('page') ? $rowsPerPage : 10000)
        );
    }

    public function update(Request $request, post $post)
    {
        $request->validate([
            'active'     => 'required',
            'featured'   => 'required',
            'title'      => 'required',
            'slug'       => 'required',
        ]);

        // Log the values of fields in the request
        Log::info('Request Data:', [$request->input('image_featured')]);

        // limit payload (no image)
        $payload = $request->only([
            'active',
            'featured',
            'title',
            'slug',
            'excerpt',
        ]);
        
        $payload['body'] = <<<EOT
        <p>Laboriosam vero ducimus quaerat ab rerum sed rerum beatae. Ut voluptas similique maxime. Est dolorem atque omnis consequatur quisquam eos quia.</p>
<p>Eos accusantium ut enim. Quisquam reprehenderit voluptatem tempore dolorem aliquid repellat quod. Non magni hic quia harum maiores culpa. Molestias id et et reprehenderit.</p>
<p>Occaecati et nam iste temporibus corrupti iusto. Et atque accusantium maiores cum repudiandae sapiente facilis. Ut velit debitis ipsum non harum perspiciatis.</p>
<p>Suscipit magni minus iste dolores qui omnis. Assumenda delectus voluptatem eveniet esse quibusdam voluptatibus autem. Facilis et eos quis. Similique qui culpa eveniet.</p>
<p>Ipsum ut autem in impedit. Alias mollitia et ut et quo eveniet. Eum totam ipsum sed magni a ut. Nostrum et labore voluptatum et accusantium.</p>
<p>Eius et consequatur quasi nobis a sit et esse. Qui non recusandae quam beatae ea. Voluptas magni impedit sit sunt omnis veritatis dolorum.</p>
EOT;

        // update post
        $post->update($payload);

        if ($request->input('image_featured') === "clear") {
            $post->clearMediaCollection('featured-images');
        }
        else {
            // save image
            $file = $request->file('image_featured');
            // Log::info('File Details:', [$request->hasFile('image_featured')]);
            if($file) {
                // clear collection because each post can only have one featured image
                $post->clearMediaCollection('featured-images');
                $post->addMediaFromRequest('image_featured')->toMediaCollection('featured-images');
            }
        }

        return response()->json(['ok' => true], 201);
    }
}