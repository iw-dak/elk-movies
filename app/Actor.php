<?php

namespace App;


use App\Observers\Searchable;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use Searchable;
    
    protected $table = 'actors';

    public function movies()
    {
        return $this->belongsToMany('App\Movie');
    }
}
