<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function test()
    {
        $movie = Movie::find(2);
        $actor = Actor::find(2);
        // $movie->actors()->attach($actor);
        // die($movie->type->label);
        die($movie->actors);
    }
}
