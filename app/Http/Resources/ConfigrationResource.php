<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConfigrationResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>(int) $this->id,
            'search_text'=>(string) $this->search_text,
            'search_count'=>(int) $this->search_count,
        ];
    }
}
