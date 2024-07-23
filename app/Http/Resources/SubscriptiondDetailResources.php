<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptiondDetailResources extends JsonResource
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
            'deltaDateMonths' => $this->deltadate_months,
            'zoneName' => $this->zone_name,
        ];
    }
}
