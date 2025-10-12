<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionStaticResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'category_id' => $this->category_id,
            'category_name' => $this->category_name,
            'total' => $this->total, 
            'average' => $this->percentage,
        ];
    }
}
