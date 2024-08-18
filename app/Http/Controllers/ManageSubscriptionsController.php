<?php

namespace App\Http\Controllers;

use App\Http\Resources\LineResource;
use App\Models\Day;
use App\Models\Line;
use App\Models\SubscriptionDetail;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ManageSubscriptionsController extends Controller
{
    public function index()
    {
        $subscriptionsavailable = SubscriptionDetail::all();
        return view(
            'admin.subscription.index',
            compact('subscriptionsavailable')
        );
    }


    public function show(Request $request)
    {
        $id = $request->input('id-subscription');
        $subscriptiondetail = SubscriptionDetail::find($id);
        if ($subscriptiondetail == null) {
            back()->withErrors(['Error' => 'Subscription Details Not Found, Same things went wrong']);
        }


        $subscriptiondetail->load([
            'lines',
            'days'
        ]);

        $lines = Line::all();

        return view(
            'admin.subscription.show',
            compact([
                'subscriptiondetail',
                'lines'
            ])
        );
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

        if (!Hash::check(
            $request->input('password'),
            $current_admin->password
        )) {
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
        $res = $sub->days()->updateExistingPivot(
            $request->input('dayId'),
            ['isAvailableRightNow' => $request->input('dayStatus')]
        );

        return back()->with(['success' => 'opration performed successfuly']);
    }

    public function fetchLinesNotAssociatedWithSD(Request $request)
    {

        $id_subscription = $request->input('subscription-id');
        $keyword = $request->input('query');

        $lines = SubscriptionDetail::find($id_subscription)->load('lines')->lines->map(fn($line) => $line->id);

        $otherLines = Line::whereNotIn(
            'id',
            $lines
        )->where('label', 'like', "$keyword%")->get();

        return LineResource::collection($otherLines);
    }


    public function addLineToSubscriptionDetail(
        Request $request,
        $subscription_id
    ) {

        $request->validate(
            [
                'password' => 'required',
                'lines' => 'required'
            ]
        );



        $current_admin = Auth::user();

        if (!Hash::check(
            $request->input('password'),
            $current_admin->password
        )) {
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
            ['status' => 'line added with success status']
        );
    }


    function addSubscriptionShow()
    {
        return view('admin.subscription.subscription-details');
    }


    public function storeSubscriptionDetails(Request $request)
    {

        $request->validate(
            [
                'zoneName' => 'required|max:255',
                'months' => 'required|int',
                'price' => 'required',
                'label' => 'required|string|max:255',
                'label_french' => 'required|string|max:255'

            ]
        );

        $current_admin = Auth::user();


        $subscription =  SubscriptionDetail::create(
            [
                'label' => $request->input('label'),
                'label_french' => $request->input('label_french'),
                'price' => $request->input('price'),
                'zone_name' => $request->input('zoneName'),
                'deltadate_months' => $request->input('months')
            ]
        );


        $subscription->days()->attach(Day::all());

        return back()->with(
            ['status' => 'Subscription Details Appended successfully']
        );
    }



    public function updateSubscription(Request $request)
    {

        $request->validate(
            [
                'password' => 'required',
                'zoneName' => 'required|max:255',
                'months' => 'required|int',
                'price' => 'required|double',
                'label' => 'required|string|max:255',
                'label_french' => 'required|string|max:255',
                'id' => 'required|int'
            ]
        );


        $current_admin = Auth::user();

        if (!Hash::check(
            $request->input('password'),
            $current_admin->password
        )) {
            return back()->withErrors([
                'status' => 'password incorrect'
            ]);
        }

        $res = SubscriptionDetail::where(
            'id',
            $request->input('id')
        )->update(
            [
                'label' => $request->input("label"),
                'label_french' => $request->input("labelFrench"),
                'price' => $request->input("price"),
                'zone_name' => $request->input("zoneName"),
                'deltadate_months' => $request->input("months")
            ]

        );

        if (!$res) {
            return back()->withError(
                ['status' => 'Current Subscription Not Available, Please make sure you have not Broke same things, in case call our technical staff']
            );
        } else {

            return back()->with(
                ['status' => 'Subscription Details Updated successfully']
            );
        }
    }

    function disableLineFromSubscription(Request $request)
    {



        // yoo it's not get request and thankes!!!



        $request->validate([
            'subscriptionDetailId' => 'required|int',
            'lineId' => 'required|int',
            'password' => 'required'
        ]);


        $admin = Auth::user();


        if (!Hash::check($request->input('password'), $admin->password)) {
            return back()->withErrors([
                'status' => 'password not correct, check your password'
            ]);
        }


        $subscription_id = $request->input('subscriptionDetailId');
        $lineId = $request->input('lineId');

        $is_detatched = 0;
        try {
            $is_detatched = SubscriptionDetail::findOrFail($subscription_id)->lines()->detach($lineId);
        } catch (ModelNotFoundException $e) {

            return back()->withErrors([
                'status' => "subscription with id $subscription_id not found"
            ]);
        }


        if ($is_detatched)
            return back()->with([
                'status' => 'line disabled successfully'
            ]);

        else
            return back()->withErrors([
                'status' => 'wrong ressource to there is not line associated with this subscription'
            ]);
    }
}
