<?php

namespace App\Http\Controllers;

use App\Models\Line;
use Illuminate\Http\Request;

class ManageLinesController extends Controller
{
    public function index()
    {
        $lines = Line::all();

        return view('admin.line.index', compact('lines'));
    }
}
