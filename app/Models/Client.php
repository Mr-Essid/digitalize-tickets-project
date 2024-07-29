<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Laravel\Sanctum\HasApiTokens;
use OpenApi\Attributes as OA;

#[ OA\Schema(
    schema: 'client'
)]

class Client extends Authenticatable 
{
    use HasFactory, HasApiTokens;


    #[ OA\Property(property:'firstname', maxLength: 255, minLength: 6) ]
    private string $firstname;


    #[ OA\Property(property: 'lastname', maxLength: 255, minLength: 6) ]
    private string $lastname;

    #[ OA\Property(property: 'email',maxLength: 255, minLength: 6) ]
    private string $email;

    #[ OA\Property(property: 'appId', maxLength: 255, minLength: 3) ]
    private string $app_id;
    
    #[ OA\Property(property: 'deviceName', maxLength: 255, minLength: 3) ]
    private string $device_name;

    #[ OA\Property(property:'password', maxLength: 255, minLength: 6) ]
    private string $password;
    private string $image_path;
    #[ OA\Property(property:'phoneNumber', maxLength: 255, minLength: 6) ]
    private string $phone_number;

    protected $fillable = [
        'firstname', 
        'lastname',
        'app_id',
        'device_name',
        'email',
        'password',
        'image_path',
        'phone_number',
    ];
    public function subscriptions() : HasMany {
        return $this->hasMany(ClientSubscription::class, foreignKey: 'client_id');
    }
}
