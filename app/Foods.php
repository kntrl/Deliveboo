<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foods extends Model
{
    public function orders()
    {
        return $this->belongsTo('App\Order');
    }

}
