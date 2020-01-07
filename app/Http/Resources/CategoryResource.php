<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'products' => $this->when($request->get('include') == 'products', ProductResource::collection($this->products)),
        ];
    }
}
