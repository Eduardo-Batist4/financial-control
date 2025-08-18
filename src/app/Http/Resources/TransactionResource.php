<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'category_id' => $this->category_id,
            'type' => $this->type,
            'price' => $this->price,
            'description' => $this->description,
            'date' => $this->date,
            'category' => [
                'name' => $this->category->name,
            ]
        ];
    }
}
