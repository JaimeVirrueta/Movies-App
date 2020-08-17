<?php

namespace App\Http\Controllers;

use App\Models\Turn;

class TurnController extends Controller
{
    public function index()
    {
        return view('turn.index', [
            'rows' => Turn::paginate()
        ]);
    }
}
