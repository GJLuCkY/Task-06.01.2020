<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'results' => [
                'categories' => CategoryResource::collection($this->categories),
                'products' => ProductResource::collection($this->products)
            ]
        ];
    }
}
