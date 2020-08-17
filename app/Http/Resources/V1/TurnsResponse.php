<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class TurnsResponse extends JsonResource
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
            'name' => $this->turn_name->format('H:i'),
            'is_active' => $this->active_text,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'links' => [
                'self' => route('turn.show', $this->id),
                'edit' => route('turn.update', $this->id),
                'delete' => route('turn.destroy', $this->id),
            ]
        ];
    }
}
