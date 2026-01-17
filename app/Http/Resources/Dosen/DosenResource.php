<?php

namespace App\Http\Resources\Dosen;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DosenResource extends JsonResource
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
            'nip' => $this->nip,
            'nama' => $this->nama,
            'jurusan' => $this->jurusan,
        ];
    }
}
