<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TenderResource extends JsonResource
{


    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->offsetGet('id'),
            'code' => $this->offsetGet('code'),
            'number' => $this->offsetGet('number'),
            'status' => $this->offsetGet('status'),
            'name' => $this->offsetGet('name'),
            'updated' => $this->offsetGet('updated_at')
        ];
    }
}
