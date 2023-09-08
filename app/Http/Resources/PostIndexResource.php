<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostIndexResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'active' => $this->active,
            'featured' => $this->featured,
            'published_at' => $this->published_at->format('M-d-Y H:i'),
            'category' => $this->whenLoaded('categories', function() {
                $mainCategory = $this->categories->filter(function ($category) {
                    return is_null($category->parent_id); // only keep categories without a parent ID
                })->first();
            
                return $mainCategory ? $mainCategory->name : null; // return the name of the main category, or null if none exists
            }),
        ];
    }
}