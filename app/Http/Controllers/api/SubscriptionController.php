<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DayResource;
use App\Http\Resources\LineResource;
use App\Http\Resources\SubscriptiondDetailResources;
use App\Models\SubscriptionDetail;


class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SubscriptiondDetailResources::collection(SubscriptionDetail::all());
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {   

        
        $subscription_details = SubscriptionDetail::find($id);
        if($subscription_details == null) {
            return response(content: ['status' => 'resource not reachable, no subscription details with id '. $id], status: 404);
        }
        $subscription_lines = LineResource::collection($subscription_details->lines()->get()); 
        $days = DayResource::collection($subscription_details->days()->withPivot('isAvailableRightNow')->get());
        $data = [
            'subscriptionDetails' => $subscription_details,
            'days' => $days,
            'lines' => $subscription_lines
        ];
        return $data;
    }

}
