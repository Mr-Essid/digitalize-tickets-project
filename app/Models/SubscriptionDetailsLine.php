<?php

namespace App\Models;

use Database\Factories\SubscriptionDetailLineFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionDetailsLine extends Model
{
    
    use HasFactory;

    public $incrementing = false;
    protected $primaryKey = ['subscription_details_id', 'line_id'];


    static public function newFactory(): Factory {
        return SubscriptionDetailLineFactory::new();
    }

}
