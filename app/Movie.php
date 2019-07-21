<?php

namespace App;

use App\Observers\Searchable;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use Searchable;
    
    protected $table = 'movies';

    //Relationships
    public function type()
    {
        return $this->belongsTo('App\Type');
    }

    public function actors()
    {
        return $this->belongsToMany('App\Actor');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }
}
