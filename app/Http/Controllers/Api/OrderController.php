<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Braintree\Gateway as Gateway;

use App\User;

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
    public function validateOrder(Request $request,Gateway $gateway)
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

}
