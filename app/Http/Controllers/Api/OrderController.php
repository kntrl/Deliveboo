<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\OrderRequest;

use Braintree\Gateway as Gateway;

//mails
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Mail;

//models
use App\User;
use App\Food;
use App\Order;


use Illuminate\Auth\Access\Gate;

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


    /**
     * receives order details (customer infos + order content) and 
     * after validating it throught validateCart creates the new order
     * attachs cart's foods and returns an Order model (and his foods)
     * via json
     * 
     * @param OrderRequest,Gateway [json and Braintree Gateway]
     *  
     * @return Order as json
     * 
     */
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
        $order->status="pending";
        $order->fill($request->all());

        $order->save();


      //calculating order total price and attaching to food_order table
        foreach($cartFoods as $cartFood) {
            $food = Food::find($cartFood['id']);
            $order->price += $food->price * $cartFood['quantity'];

            //attaching to food_order table
            $order->foods()->attach($food->id, ['quantity' => $cartFood['quantity']]);
        }
        //saving order new price.
        $order->save();

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

    /**
     * Generates tr ansaction from order.
     * Checks if order is already paid, if so returns json error and status 404.
     * 
     * @param Request,Gateway (Request contains order and payment_method_nonce)
     * 
     * @return Order json
     */
    
    public function createTransaction(Request $request,Gateway $gateway)
    {
        $data = $request->all();

        if(!$order = Order::find($data['order_id'])) {
            return response()->json(["messagge"=>"Order not found","order"=>$order],404);
        }


        //checking order status not being already completed.
        if ((!$order->status == "pending" || !$order->status == "rejected")){
            return response()->json(["messagge"=>"Transaction has already been completed","order"=>$order],404);
        }

    

        //creating transaction
        $result = $gateway->transaction()->sale([
            'amount' => $order->price,
            'paymentMethodNonce' => $data['nonceFromTheClient'],
            'orderId'=> $order->id,
            'options' => [
                'submitForSettlement' => true
            ],
        ]);


        //updating order status according to sale result.
        if (!$result->success) {
            $order->status ="rejected";
            return response()->json(["message"=>$result->message,"order"=>$order],400);
        }

        $order->status = "accepted";

        $order->braintree_transaction_id = $result->transaction->orderId;

        $order->save();

        Mail::to($order->email)->send(new OrderConfirmationMail($order));
        return response()->json(["message"=>"Pagamento effettuato con successo","order"=>$order],200);
    }


}
