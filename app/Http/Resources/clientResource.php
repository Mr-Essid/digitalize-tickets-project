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
            'firstname' => $this->firstname,
            'lastName'=> $this->lastname,
            'mailVerified' => $this->mail_verified,
            'phoneNumber' => $this->phone_number,
            'deviceName' => $this->deviceName,
            'imagePath' => $this->image_path,
            'email' => $this->email,
            'wallet' => $this->wallet,
            'deviceName' => $this->device_name,
            'appId' => $this->app_id,
            'role' => $this->role
        ];
    }
}
