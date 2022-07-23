<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class AdvertisementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'title' => $this->title,
            'description' => $this->description,
            'start_date' => $this->start_date->toDateTimeString(),
            'created_at' => $this->created_at->toDateTimeString(),
            'category' => $this->category()->pluck('id', 'name'),
            'user' => $this->user()->pluck('id', 'name'),
            'tags' => $this->tags()->pluck('tags.id', 'tags.name'),
        ];
    }
}
