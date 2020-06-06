<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MainImage as MainImageResource;

class News extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'publication_date' => $this->publication_date,
            'title' => $this->title,
            'author' => $this->author,
            'body' => $this->body,
            'summary' => $this->summary,
            'category' => $this->category->name ?? $this->category,
            'main_image' => new MainImageResource($this->mainImage)
        ];
    }
}
