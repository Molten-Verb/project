<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RacerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'country' => $this->country,
            'price' => $this->price,
        ];
    }

    public function with(Request $request): array
    {
        // Добавляем метаданные пагинации
        return [
            'meta' => [
                'current_page' => $this->resource->currentPage(),
                'last_page' => $this->resource->lastPage(),
                'total' => $this->resource->total(),
            ],
        ];
    }
}
