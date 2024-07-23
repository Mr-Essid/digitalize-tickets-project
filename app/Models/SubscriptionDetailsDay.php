<?php

namespace App\Models;

use Database\Factories\SubscriptionDetailDayFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SubscriptionDetailsDay extends Model
{

    use HasFactory;
    public $incrementing = false;
    protected $primaryKey = ['subscription_details_id', 'day_id'];
    protected $fillable = ['subscription_details_id', 'day_id', 'isAvailableRightNow'];

    static public function newFactory(): Factory {
        return SubscriptionDetailDayFactory::new();
    }


    

}
