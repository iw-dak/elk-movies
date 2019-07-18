<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'type';

    public function movies()
    {
        return $this->hasMany('App\Movie');
    }
}
