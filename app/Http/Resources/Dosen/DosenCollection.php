<?php

namespace App\Http\Resources\Dosen;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DosenCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
       return [
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'Successfully fetched all dosens',
            ],
            'data' => DosenResource::collection($this->collection),
        ];
    }
}
