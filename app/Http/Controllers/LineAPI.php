<?php

namespace App\Http\Controllers;

use App\Models\Line;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class LineAPI extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $lineID)
    {
        $line = Line::where('label', $lineID)->first();




        if ($line == null) {
            return response(content: [

                'status' => 'opration failed',
                'description' => 'Line doesnt exists'
            ]);
        }

        $currentDayOfTheWeek = Date::now()->toArray()['dayOfWeek'];

        $subscriptionDetailsValid =  $line->subscriptionDetails()
            ->get()
            ->load(['days' => fn($query) => $query->where('day_week', $currentDayOfTheWeek)
                ->first()])->filter(fn($subscriptionDetails) => $subscriptionDetails->days->first()
                ->pivot->isAvailableRightNow == 1)
            ->load('subscriptionClients.client')
            ->map(fn($subDetails) => $subDetails->subscriptionClients);

        $clientCollection = collect([]);

        foreach ($subscriptionDetailsValid as $index => $value) {
            foreach ($value as $key => $nestedValue) {
                if (!$clientCollection->contains($nestedValue->client->id)) {
                    $clientCollection->add($nestedValue->client->id);
                }
            }
        }

        return $clientCollection;






        $list_subscriptionsd = $line->subscriptionDetails();
    }
}
