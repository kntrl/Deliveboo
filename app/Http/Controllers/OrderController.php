<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;

use App\User;
use App\Order;
use App\Food;

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


        $order = new Order();

        //checking that each food belongs to $user Restaurant and create total price of order
        foreach ( $form_data['foods'] as $food_id) {

            if(!in_array($food_id ,$idFoodUser)) {
                return redirect()->route('home');
            }

            if(!$form_data['quantity'. $food_id] > 0) {
                return redirect()->route('guest.orders.create',["user"=>$user]);
            }

            $food = Food::find($food_id);
            $order->price += $food->price * $form_data['quantity'. $food_id];

        }


        $order->fill($form_data);

        $order->status = 'pending';

        $saved = $order->save();

        

        // Attach Food_quantity on order
        foreach ($form_data['foods'] as $food_id ) {

            $order->foods()->attach($food_id, ['quantity' => $form_data['quantity'. $food_id] ]);

        }
       
    

        if(!$saved) {
            abort('404');
        }

        return redirect()->route('guest.setupPayment', ['order' => $order]);
    }}
