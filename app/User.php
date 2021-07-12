<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','piva','address','description'
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
        return $this->belongsToMany('App\Category');
    }

    public function foods() 
    {
        return $this->hasMany('App\Food');
    }

    /**
     * Checks if a food id belongs to user.
     * if true,returns the food 
     * if false aborts(404)
     * @param foodId
     * @return App\Food or 404
     */
    public function foodOrFail($foodId)
    {
        if ($food = $this->foods->firstWhere('id',$foodId)){
            return $food;
        } else {
            abort(404);
        }

    }
}
