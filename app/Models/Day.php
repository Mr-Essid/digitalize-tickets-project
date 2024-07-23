<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Day extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'short_name', 'french_name', 'french_short_name'];
    
    
    public  function  subscriptionDetails(): BelongsToMany {
        return $this->BelongsToMany(SubscriptionDetail::class, 'subscription_details_days', 'day_id', 'subscription_details_id');
    }
}
