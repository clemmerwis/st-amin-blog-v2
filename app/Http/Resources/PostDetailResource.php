<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostDetailResource extends JsonResource
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
            'id'           => $this->id,
            'title'        => $this->title,
            'slug'         => $this->slug,
            'active'       => $this->active,
            'excerpt'      => $this->excerpt,
            'body'         => $this->body,
            'featured'     => $this->featured,
            'published_at' => $this->published_at->format('M-d-Y H:i'),
            'category'     => $this->categories,
        ];
    }
}
