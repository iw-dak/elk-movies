<?php

namespace App\Movies;

use Illuminate\Database\Eloquent\Collection;

interface MoviesRepository
{
    public function search($query = "", $instance): Collection;
}
