<?php

namespace App\Http\Resources;

use App\Models\Day;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionDetails extends JsonResource
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
            'label' => $this->label,
            'labelFrench' => $this->label_french,
            'price' => $this->price,
            'zoneName' => $this->zone_name,
            'months' => $this->deltadate_months,
            'lines' => LineResource::collection($this->lines),
            'days' => DayResource::collection($this->days)
        ];
    }
}
