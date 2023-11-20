<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryDetailResource extends JsonResource
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
            'id'         => $this->id,
            'name'       => $this->name,
            'slug'       => $this->slug,
            'parent_id'  => $this->parent_id ?? null,
            'created_at' => optional($this->created_at)->format('M-d-Y'),
            'updated_at' => optional($this->updated_at)->format('M-d-Y H:i'),
        ];
    }
}
