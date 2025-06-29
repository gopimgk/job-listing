<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
{
    return [
        'id' => $this->id,
        'title' => $this->title,
        'company' => $this->company,
        'location' => $this->location,
        'type' => $this->type,
        'description' => $this->description,
        'posted_by' => $this->user->name,
    ];
}

}
