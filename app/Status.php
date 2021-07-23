<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public $timestamps = false;
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
