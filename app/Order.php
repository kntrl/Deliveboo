<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'delivery_address',
        'phone',
        'status'
    ];

    public function foods()
    {
        return $this->belongsToMany(Food::class)->withPivot('quantity','note');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * retrives all Orders for a given user Id
     * @param int users.id
     * 
     * @return Order eloquent collection
     */
    public function getOrderByUser($userID)
    {
        $orders = Order::join('food_order', 'orders.id', '=', 'food_order.order_id')
        ->join('foods', 'foods.id', '=', 'food_order.food_id')
        ->join('users', 'users.id', '=', 'foods.user_id')
        ->where('users.id','=',$userID)
        ->select('orders.*')
        ->orderBy('id','desc')
        ->get()->unique();

        return $orders;
    }
}
