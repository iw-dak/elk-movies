<?php

namespace App\Movies;

use App\Movie;
use AppArticle;
use App\Movies\MoviesRepository;
use Illuminate\Database\Eloquent\Collection;

class EloquentMoviesRepository implements MoviesRepository
{
    public function search(string $query = ""): Collection
    {
        // die($query);
        return Movie::where('name', 'like', "%{$query}%")
            ->orWhere('releaser', 'like', "%{$query}%")
            ->get();
    }
}
