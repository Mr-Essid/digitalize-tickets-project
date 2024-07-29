<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ManageClientsController extends Controller
{

    public function getuserbyid(Request $request, int $id)
    {
        $client = Client::find($id);
        if ($client == null) {
            return response(status: 404, content: [
                'status' => 'client with id ' . $id . 'not found',
                'desription' => 'client you are looking for not exits'
            ]);
        }

        return new ClientResource($client);
    }


    public function searchforclient(Request $request)
    {

        $keyword = $request->input('q');

        $res = preg_replace('/[^a-zA-Z0-9_ -]/s', '', $keyword);
        $byname = Client::where('firstname', 'like', "$res%")->where('role', '!=', 'ADMIN')->where('mail_verified', 1)->limit(5)->get();
        $bylastname = Client::where('lastname', 'like', "$res%")->where('role', '!=', 'ADMIN')->where('mail_verified', 1)->limit(5)->get();
        $email = Client::where('email', 'like', "$res%")->where('role', '!=', 'ADMIN')->where('mail_verified', 1)->limit(5)->get();

        return [
            'status' => 'ok',
            'byName' => $byname,
            'byEmail' => $email,
            'byLastname' => $bylastname
        ];
    }

    public function clientdetails(Request $request)
    {

        $id = $request->input('client-id');
        if ($id == null) {
            return back()->withErrors(['id-missing', 'query required id of client, plase make sure you have the right to do']);
        }

        $client = Client::find($id);
        if ($client == null) {
            return back()->withErrors(['id-missing', 'query required id of client, plase make sure you have the right to do']);
        }

        $subscriptions = $client->subscriptions()->get()->load('subscriptionDetails');
        $list_to_view = ['client'];

        return view('admin.client-details', compact(['client', 'subscriptions']));
    }


    public function addtowallet(Request $request)
    {
        $request->validate([
            'id' => 'required|int',
            'password' => 'required|min:4|max:255',
            'amount' => 'required|decimal:0,1'
        ]);



        $current_admin = Auth::user();
        if ($current_admin->role != 'ADMIN') {
            return back()->withErrors(['error' => 'access deny, request not permitted']);
        }

        if (!Hash::check($request->password, $current_admin->password)) {
            return back()->withErrors(['error' => 'password incorrect']);
        }

        $amount = $request->input('amount');
        $client = Client::where('id', $request->input('id'))->where('mail_verified', 1)->where('role', 'CLIENT')->first();

        if ($client == null) {
            return back()->withErrors(['client' => 'client account does not active yet']);
        }
        $client->wallet = $client->wallet + $amount;
        $client->save();
        return back()->with(['success', 'opration perfomed successflly']);
    }
}
