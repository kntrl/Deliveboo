<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = "foods";
    
    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }
}
