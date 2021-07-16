<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'address'
    ];

    public function foods()
    {
        return $this->belongsToMany(Food::class)->withPivot('quantity','note');
    }
}
