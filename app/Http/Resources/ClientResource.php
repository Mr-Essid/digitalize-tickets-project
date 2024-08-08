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
            "firstName" => $this->firstname,
            "lastName" => $this->lastname,
            "emailVerified" => $this->mail_verified,
            "email" => $this->email,
            "wallet" => $this->wallet,
            "imagePath" => $this->image_path,
            "phoneNumber" => $this->phone_number,
            "deviceName" =>  $this->device_name,
            "appId" => $this->app_id,
            'subscriptions' => Subscriptions::collection($this->subscriptions)

        ];
    }
}
