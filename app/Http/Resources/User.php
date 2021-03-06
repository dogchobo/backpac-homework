<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
            'name' => $this->name,
            'nickname' => $this->nickname,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'gender' => $this->when($this->gender, $this->gender),
            'api_token' => $this->when($this->api_token, $this->api_token),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
