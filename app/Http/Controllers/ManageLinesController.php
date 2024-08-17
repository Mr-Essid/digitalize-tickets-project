<?php

namespace App\Http\Controllers;

use App\Models\Line;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ManageLinesController extends Controller
{
    public function index()
    {
        $lines = Line::all();

        return view('admin.line.index', compact('lines'));
    }



    public function addLine(Request $request)
    {

        $admin = Auth::user();


        $request->validate([
            'lineLabel' => 'required|max:50',
            'password' => 'required'
        ]);

        if (!Hash::check($request->input('password'), $admin->password)) {
            return back()->withErrors(["status" => "password incorrect"]);
        }

        Line::create(['label' => $request->input('lineLabel')]);

        return back()->with(["status" => "line appended successfully"]);
    }


    public function updateLine(Request $request)
    {


        $admin = Auth::user();


        $request->validate([
            'id' => 'required|int',
            'new_label' => 'required|max:50',
            'password' => 'required'
        ]);

        if (!Hash::check($request, $admin->password)) {
            return back()->withErrors(["status" => "password incorrect"]);
        }

        $line = Line::find($request->input('id'));

        if ($line == null) {
            return back()->withErrors(["same things went wrong"]);
        }

        $line->label = $request->input('new_label');
        $line->save();

        return back()->with(["status" => "line updated successfully"]);
    }

    function deleteLine(Request $request)
    {

        $admin = Auth::user();

        $request->validate([
            'id' => 'required|int',
            'password' => 'required'
        ]);

        if (!Hash::check($request, $admin->password)) {
            return back()->withErrors(["status" => "password incorrect"]);
        }

        $line = Line::find($request->input('id'));

        if ($line == null) {
            return back()->withErrors(["same things went wrong"]);
        }

        $line->delete();

        return back()->with(["status" => "line deleted successfully"]);
    }
}
