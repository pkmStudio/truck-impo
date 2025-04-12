<?php

namespace App\Http\Resources\Metatag;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MetatagResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'meta_h1' => $this->meta_h1,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
        ];
    }
}
