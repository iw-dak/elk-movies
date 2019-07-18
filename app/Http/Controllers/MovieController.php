<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function test()
    {
        $movie = Movie::find(2);
        // die($movie->type->label);
        die($movie->reviews);
        // return view('', []);
    }
}
