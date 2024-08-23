<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LicenceResource extends JsonResource
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
            'licence_type_id' => $this->licence_type_id,
            'notification_id' => $this->notification_id,
            'licence_type' => $this->licenceType->name,
            'duration_type' => $this->notification->duration_type,
            'name' => $this->name,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'provider' => $this->provider,
            'amount' => $this->amount
        ];
    }
}
