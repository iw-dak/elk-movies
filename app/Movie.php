<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'movies';


    //Relationships
    public function comments()
    {
        return $this->hasMany('App\Review');
    }

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
