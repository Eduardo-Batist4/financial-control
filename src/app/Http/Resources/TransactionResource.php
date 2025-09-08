<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'amount' => $this->amount,
            'description' => $this->description,
            'date' => $this->date,
            'category' => [
                'id' => $this->category->id,
                'name' => $this->category->name,
            ]
        ];
    }
}
