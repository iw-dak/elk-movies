<?php

namespace App;

use App\Observers\Searchable;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use Searchable;
    
    protected $table = 'type';

    public function movies()
    {
        return $this->hasMany('App\Movie');
    }
}
