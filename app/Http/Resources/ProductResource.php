<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'extra_data' => $this->extra_data,
            'price' => $this->price,
            'description' => $this->description,
            'image' => url('/' . $this->image),
            'user_id' => $this->user_id,
            'store'=>$this->whenLoaded('store')
        ];
    }
}
