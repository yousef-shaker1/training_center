<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResponce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'section_id' => $this->section_id,
            'img' => $this->img,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'Numberofhours' => $this->Numberofhours,
            'Quantity' => $this->Quantity,
            'type' => $this->type,
            'start_data' => $this->start_data,
            'end_data' => $this->end_data,
        ];
    }
}
