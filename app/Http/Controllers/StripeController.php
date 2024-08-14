<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Cart;
use App\models\Order;
use App\Models\Plan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stripe;
use Exception;

class StripeController extends Controller
{
     public function stripe(Request $request)
    {
        $count = Cart::where('user_id', $request->user_id)->count();
        return view('stripe',['total_amount'=>$request->total_amount,'count'=>$count]);
    }

    public function stripePost(Request $request)
    { 
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $charge=Stripe\Charge::create ([
                "amount" => $request->total_amount * 100,
                "currency" => "USD",
                "source" => $request->stripeToken,
                "description" => "Test payment." ,
                'metadata' => ['order_id' => '1']
        ]);

        if($charge->status=='succeeded'){
        $cartIds = json_decode($request->input('cart_id'));
        if(!empty($cartIds)){
            foreach($cartIds as $cart) {   
                $item=Cart::where('id', $cart)->first(); 
                $orders = new Order;
                $orders->food_id = $item->food_id;
                $orders->user_id = $item->user_id;
                $orders->quantity = $item->quantity;
                $orders->status = 'paid';
                $orders->save();
            }
            $cartRemove=Cart::whereIn('id',$cartIds)->delete();
        }
        return redirect()->route('home')->with('success', 'Payment has been done successfully!');
        }else{
            return redirect()->route('home')->with('error', 'Payment has been failed!');
        }
    }

}
