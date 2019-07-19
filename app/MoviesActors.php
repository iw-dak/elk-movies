<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class MoviesActors extends Pivot
{
    protected $table = 'actor_movie';

}
