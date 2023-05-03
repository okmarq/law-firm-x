<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (string)$this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'date_profiled' => $this->date_profiled,
            'last_notification' => $this->last_notification,
            'primary_legal_counsel' => $this->primary_legal_counsel,
            'date_of_birth' => $this->date_of_birth,
            'profile_image' => $this->profile_image,
            'case_detail' => $this->case_detail
        ];
    }
}
