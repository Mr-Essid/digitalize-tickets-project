<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\SubscriptionDetail;
use Database\Factories\ClientSubscriptionDetailsFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ClientSubscription extends Model
{
    use HasFactory;   
     
    public $timestamps = false;

    protected static function newFactory(): Factory
    {
        return ClientSubscriptionDetailsFactory::new();
    }
   
    public function client(): BelongsTo {
        return $this->belongsTo(Client::class, foreignKey:'client_id');
    }

    public function subscriptionDetails(): BelongsTo {
        return $this->belongsTo(SubscriptionDetail::class, 'subscription_details_id');
    }
}
