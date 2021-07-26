<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\VerifyEmailNotification;
use App\Providers\RouteServiceProvider;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'name', 
            'email', 
            'password',
            'piva',
            'phone',
            'address',
            'description',
        ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function categories() 
    {
        return $this->belongsToMany(Category::class);
    }

    public function foods() 
    {
        return $this->hasMany(Food::class);
    }

    /**
     * Checks if a food id belongs to user.
     * if true,returns the food 
     * if false aborts(404)
     * @param foodId
     * @return App\Food or redirects to previews page.
     */
    public function foodOrFail($foodId)
    {
        if (!$food = $this->foods->firstWhere('id',$foodId)){
            abort(403);
        } 

        return $food;
    }

    /**
     * Sending custom Email Verification mail to last registered user
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification());
    }


    /**
     * retrieves $limit number of most sold foods
     * @param int results number
     * @return Collection
     * 
     */
    public function bestSellers($limit)
    {
        return $this->foods->toQuery()
        ->join('food_order','foods.id','=','food_order.food_id')
        ->selectRaw('foods.id,foods.name,sum(food_order.quantity) as orderedTimes')
        ->groupBy('foods.id')
        ->orderByDesc('orderedTimes')
        ->limit($limit)
        ->get();
    }
}
