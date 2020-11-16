<?php

namespace App\Http\Resources;

use App\Http\Resources\Choice as ChoiceResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Question extends JsonResource
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
            'question' => $this->question,
            'is_general' => $this->is_general,
            'category' => $this->category,
            'point' => $this->point,
            'icon_url' => $this->icon_url,
            'duration' => $this->duration,
            'choices' => ChoiceResource::collection($this->whenLoaded('choices')),
        ];
    }
}
