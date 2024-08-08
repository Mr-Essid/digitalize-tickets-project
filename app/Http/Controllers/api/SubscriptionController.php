<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DayResource;
use App\Http\Resources\LineResource;
use App\Http\Resources\SubscriptionAllDetailsResource;
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
        if ($subscription_details == null) {
            return response(content: ['status' => 'resource not reachable, no subscription details with id ' . $id], status: 404);
        }

        $subscription_details->load(['lines', 'days']);

        return new SubscriptionAllDetailsResource($subscription_details);
    }
}
