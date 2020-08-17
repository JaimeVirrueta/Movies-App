<?php

namespace App\Http\Controllers;

use App\Models\Movie;

class MovieController extends Controller
{
    public function index()
    {
        return view('movie.index', [
            'rows' => Movie::withCount('turns')->paginate()
        ]);
    }
}
