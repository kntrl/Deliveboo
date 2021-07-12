<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = "foods";

    protected $fillable = [
        "name",
        "ingredients",
        "price",
        "course",
        "available",
        "is_vegan",
        "is_hot",
        "is_lactose_free",
        "is_veggy",
        "is_gluten_free"
    ];

    public $timestamps = false;
    
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function orders()
    {
        return $this->belongsToMany('App\Order')->withPivot('quantity', 'note');
    }

    public function foodTypes()
    {
        return [
            "is_vegan",
            "is_hot",
            "is_lactose_free",
            "is_veggy",
            "is_gluten_free"
        ];
    }
}
