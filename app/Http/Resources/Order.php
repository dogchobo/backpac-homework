<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Order extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'product_name' => $this->product_name,
            'order_number' => $this->order_number,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
