<?php

namespace App\Movies;

use Illuminate\Database\Eloquent\Collection;

interface MoviesRepository
{
    public function search(string $query = "", $instance): Collection;
}
