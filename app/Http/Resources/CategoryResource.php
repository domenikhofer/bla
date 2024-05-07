<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'emoji' => $this->emoji,
            'subcategories' => CategoryResource::collection($this->children),
            'category_type_id' => $this->category_type_id,
            'deleted_at' => $this->deleted_at,
            'parent_id' => $this->parent_id,

        ];
    }
}
