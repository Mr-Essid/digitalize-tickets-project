<?php

namespace App\Http\Controllers;

use App\Http\Resources\LineResource;
use App\Models\Day;
use App\Models\Line;
use App\Models\SubscriptionDetail;
use App\Models\SubscriptionDetailsLine;
use Database\Factories\SubscriptionDetailLineFactory;
use Doctrine\Common\Annotations\Annotation\Required;
use Dotenv\Parser\Lines;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ManageSubscriptionsController extends Controller
{
    public function index()
    {
        $subscriptionsavailable = SubscriptionDetail::all();
        return view('admin.subscription.index', compact('subscriptionsavailable'));
    }


    public function show(Request $request)
    {
        $id = $request->input('id-subscription');
        $subscriptiondetail = SubscriptionDetail::find($id);
        if ($subscriptiondetail == null) {
            back()->withErrors(['Error' => 'Subscription Details Not Found, Same things went wrong']);
        }


        $subscriptiondetail->load(['lines', 'days']);

        $lines = Line::all();

        return view('admin.subscription.show', compact(['subscriptiondetail', 'lines']));
    }

    public function toggleday(Request $request)
    {


        $request->validate([
            'dayId' => 'required|int',
            'dayStatus' => 'required|int|in:0,1',
            'password' => 'required',
            'subscriptionDetailId' => 'required|int'
        ]);

        $current_admin = Auth::user();

        if (!Hash::check($request->input('password'), $current_admin->password)) {
            return back()->withErrors(
                ['x-authorization' => 'password incorrect']
            );
        }

        $sub = SubscriptionDetail::find($request->input('subscriptionDetailId'));

        if ($sub == null) {
            back()->withErrors(
                [
                    '404' => 'subscription details does not exists, same things went wrong'
                ]
            );
        }
        $res = $sub->days()->updateExistingPivot($request->input('dayId'), ['isAvailableRightNow' => $request->input('dayStatus')]);

        return back()->with(['success' => 'opration performed successfuly']);
    }

    public function fetchLinesNotAssociatedWithSD(Request $request)
    {

        $id_subscription = $request->input('subscription-id');
        $keyword = $request->input('query');

        $lines = SubscriptionDetail::find($id_subscription)->load('lines')->lines->map(fn($line) => $line->id);

        $otherLines = Line::whereNotIn('id', $lines)->get();

        return LineResource::collection($otherLines);
    }


    public function addLineToSubscriptionDetail(Request $request, $subscription_id)
    {

        $request->validate(
            [
                'password' => 'required',
                'lines' => 'required'
            ]
        );



        $current_admin = Auth::user();

        if (!Hash::check($request->input('password'), $current_admin->password)) {
            return back()->withErrors([
                'authorization' => 'password incorrect'
            ]);
        }


        $sub = SubscriptionDetail::find($subscription_id);

        if ($sub == null) {
            return back()->withErrors(
                [
                    '404' => 'subscription not exists, same things went wrong'
                ]
            );
        }

        $sub->lines()->attach($request->input('lines'));

        return back()->with(
            ['success' => 'action perfomed successfully']
        );
    }
}
