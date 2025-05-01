<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\Metatag\MetatagResource;
use App\Http\Resources\Product\ProductShortResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryPartResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'image_path' => $this->image_url,
            'slug' => $this->slug,
            'metatags' => MetatagResource::make($this->metatags),
            'products' => ProductShortResource::collection($this->whenLoaded('products')),
        ];
    }
}
