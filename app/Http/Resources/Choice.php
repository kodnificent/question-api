<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Choice extends JsonResource
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
            'description' => $this->description,
            'icon_url' => $this->icon_url,
            'is_correct_choice' => $this->is_correct_choice
            // in a production application, we can conditionally
            // show is correct choice only to users with the
            // right priviledges so that we do not expose the answer to the api
        ];
    }
}
