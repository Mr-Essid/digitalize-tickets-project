<?php

namespace App\Http\Controllers;

use App\Models\Line;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class LineAPI extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $lineLabel)
    {
        $line = Line::where('label', $lineLabel)->first();

        if($line == null) {
            return response(content: [

                'status' => 'opration failed',
                'description' => 'Line doesnt exists'
            ]);
        }
        
        $current_day_of_the_week = Date::now()->toArray()['dayOfWeek'];
        $list_subscriptionsd = $line->subscriptionDetails();
        $list_subscriptionsd->load([
            'subscriptionClients',
            'days' => fn($query) => $query->where('isAvailableRightNow', 1)
        ]);
        
        

    }

}
