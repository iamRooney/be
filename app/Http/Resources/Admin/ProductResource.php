<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;


class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [

            'id' => $this->id,

            'company' => $this->company?->name,

            'category' => $this->category?->name,

            'name' => $this->name,

            'slug' => $this->slug,

            'short_description' => $this->short_description,

            'description' => $this->description,


            'image' => $this->image
                ? asset(Storage::url($this->image))
                : null,

            'price' => $this->price,

            'unit' => $this->unit,

            'status' => $this->status,

            'featured' => $this->featured,

            'views' => $this->views,

            'created_at' => $this->created_at?->format('d M Y'),

        ];
    }
}
