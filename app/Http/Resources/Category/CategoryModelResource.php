<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\Metatag\MetatagResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryModelResource extends JsonResource
{

    /**
     * @param Request $request
     * @return array
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
            'parts' => CategoryShortResource::collection($this->whenLoaded('parts')),
        ];
    }
}
