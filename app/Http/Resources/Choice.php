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
            // is_correct_choice is purposely ommitted
            // so that we do not expose the answer to the api
            // except when maybe a user has answered the question
            // or has the right priviledges to view the answers.
        ];
    }
}
