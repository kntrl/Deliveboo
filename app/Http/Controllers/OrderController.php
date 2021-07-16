<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;

use App\User;
use App\Order;

class OrderController extends Controller
{

    public function create(User $user)
    {
        return view('guest.orders.create', compact('user'));
    }

    public function store(OrderRequest $request, User $user)
    {
        $form_data = $request->all();

        //retrievs all $user Restaurant Foods id
        $idFoodUser = $user->foods->modelKeys();

        //checking that each food belongs to $user Restaurant
        foreach ( $form_data['foods'] as $food_id) {

            if(!in_array($food_id ,$idFoodUser)) {
                return redirect()->route('home');
            }
        }

        dd('tutto regolare');

        $order = new Order();

        $order->fill($form_data);


        $saved = $order->save();

        if(!$saved) {
            abort('404');
        }
        return view('welcome');
    }}
