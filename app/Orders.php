<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    public function foods()
    {
        return $this->belongsToMany('App\Food');
    }
}
