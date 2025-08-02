<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => UserResource::collection($this->collection),
            'meta' => [
                'total' => $this->collection->count(), // количество элементов
                'generated_at' => now()->toDateTimeString(), // дата генерации
                'author' => 'HostelTrack API', // подпись
                'path' => $request->path(), // текущий URL
            ],
        ];
    }
}
