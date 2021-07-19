<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\OrderRequest;

use Braintree\Gateway as Gateway;

use App\User;
use App\Food;
use App\Order;

class OrderController extends Controller
{

    /**
     * validates the order checking if restaurant(user) exists
     * and if each food belongs to that restaurant(user)
     * 
     * @param json request 
     * 
     * @return clientToken as json or 404
     * 
     *  request format example : https://pastebin.com/HLL1udk3
     *  */
    public function validateCart(Request $request,Gateway $gateway)
    {
        $data = $request->all();
        $order = $data['order'];
        $response=[
            'data' => [
                'clientToken'=> $gateway->clientToken()->generate()
            ]
        ];


        //retrieving user and checking it exists
        if (!$restaurant =  User::where('slug','=',$order['restaurant'])->first()) {
            $response = [
                'data' => [
                    'error' => 'Restaurant \''.$order['restaurant'].'\' not found' 
                ]
            ];
            return response()->json($response,404);
        } 

        //checking that foods in the request belongs to user
        $restaurantFoodsID = $restaurant->foods->modelKeys();
        foreach ($order['foods'] as $food) {
            if(!in_array($food['id'],$restaurantFoodsID)) {
                $response = [
                    'data' => [
                        'error' => 'Food \''.$food['name']. '\' doesn\'t belong to\''.$restaurant->name.'\''
                    ]
                ];
                return response()->json($response,404);
            }
        }

        //returning Client Token
        return response()->json($response);

    }

    public function validateOrder(OrderRequest $request, Gateway $gateway)
    {
        //validating Order data
        $clientTokenJson = $this->validateCart($request,$gateway);
    
        //if validation fails it returns validateCart response
        if(!isset(json_decode($clientTokenJson->content())->data->clientToken)){
            return response()->json(json_decode($clientTokenJson->content()),404);
        }

        //if it succeed we retrieve clientToken
        $clientToken = json_decode($clientTokenJson->content())->data->clientToken;
        
        //retrieving cart foods
        $cartFoods = $request->input('order.foods');

        //creating the order
        $order = new Order();
        $order->price = 0;
        $order->fill($request->all());

        $order->save();


      //calculating order total price and attaching to food_order table
        foreach($cartFoods as $cartFood) {
            $food = Food::find($cartFood['id']);
            $order->price += $food->price * $cartFood['quantity'];

            //attaching to food_order table
            $order->foods()->attach($food->id, ['quantity' => $cartFood['quantity']]);
        }

        //loading order foods for response
        $order->foods;
        $response = [
            "data" => [
                "order" => $order,
                "clientToken" => $clientToken
            ]
        ];

        //return response as https://pastebin.com/cmuaq3BD
        return response()->json($response);

    }

}
