<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubscriptionDetail;

class Line extends Model
{
    use HasFactory;
    protected $fillable = ['label'];


    public function SubscriptionDetails() {
        return $this->belongsToMany(SubscriptionDetail::class, 'subscription_details_lines', 'line_id', 'subscription_details_id');
    } 
}
