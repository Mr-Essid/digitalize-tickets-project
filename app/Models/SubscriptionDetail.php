<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubscriptionDetail extends Model
{
    use HasFactory;
    protected $fillable = ['label', 'label_french', 'price', 'zone_name', 'deltadate_months'];


    public function subscriptionClients() : HasMany {
        return $this->hasMany(ClientSubscription::class, foreignKey: 'subscription_details_id');
    }


    public function days(): BelongsToMany {
        return $this->belongsToMany(Day::class, 'subscription_details_days', 'subscription_details_id', 'day_id');
    }


 
    public function lines() {
        return $this->belongsToMany(Line::class, 'subscription_details_lines', 'subscription_details_id', 'line_id');
    }    

}
