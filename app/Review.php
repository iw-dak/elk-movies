<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';


    public function movie()
    {
        return $this->belongsTo('App\Movie');
    }
    
}
