<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\models\Food;
use App\models\FoodChef;
use App\models\Cart;
use App\models\Order;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

use Stripe;
class HomeController extends Controller
{
    public function index()
    {
        $food = food::all();
        $foodchef = foodchef::all();
        $count = 0;
        if (Auth::id()) {
            $user_id = Auth::id();
            $cart_id = array_column(json_decode(order::get('cart_id'), true), 'cart_id');
            $count = cart::where('user_id', $user_id)->whereNotIn('id', $cart_id)->count();
        }
        return view("home", compact("food", "foodchef", "count"));
    }

    public function redirects()
    {
        $food = food::all();
        $foodchef = foodchef::all();
        $usertype = Auth::user()->usertype;
        if ($usertype == '1') {
            return view('admin.adminhome');
        } else {
            $user_id = Auth::id();
            $cart_id = array_column(json_decode(order::get('cart_id'), true), 'cart_id');
            $count = cart::where('user_id', $user_id)->whereNotIn('id', $cart_id)->count();
            return view('home', compact("food", "foodchef", "count"));
        }
    }

    public function addcart(Request $request, $id)
    {
        if (Auth::id()) {
            $user_id = Auth::id();
            $food_id = $id;

            $count = cart::where('user_id', $user_id)->where('food_id', $food_id)->count();
            if ($count > 0) {
                $id = cart::where('user_id', $user_id)->where('food_id', $food_id)->value('id');
                $old_quantity = cart::where('user_id', $user_id)->where('food_id', $food_id)->value('quantity');
                $new_quantity = $request->quantity;
                $quantity = $new_quantity + $old_quantity;
                $cart = cart::find($id);
                $cart->user_id = $user_id;
                $cart->food_id = $food_id;
                $cart->quantity = $quantity;
                $cart->save();
            } else {
                $quantity = $request->quantity;
                $cart = new cart;
                $cart->user_id = $user_id;
                $cart->food_id = $food_id;
                $cart->quantity = $quantity;
                $cart->save();
            }
            return redirect()->back();
        } else {
            return redirect('/login');
        }
    }

    public function showcart(Request $request, $id)
    {
        $user_id=$id;
        $count = cart::where('user_id', $user_id)->count();
        $cart_id = array_column(json_decode(order::get('cart_id'), true), 'cart_id');
       $cartData = Cart::join('food', 'carts.food_id', '=', 'food.id')
        ->join('users', 'carts.user_id', '=', 'users.id')
        ->select(
            'carts.food_id',
            'food.title',
            'food.description',
            'food.price',
            'food.image',
            'carts.id as cart_id',
            DB::raw('SUM(carts.quantity) as total_quantity'),
            DB::raw('SUM(carts.quantity * food.price) as total_amount'),
            DB::raw('SUM(SUM(carts.quantity * food.price)) OVER () as grand_total')
        )
        ->where('carts.user_id', $user_id)
        ->whereNotIn('carts.id', $cart_id)
        ->groupBy('carts.food_id', 'food.title', 'food.description', 'food.price', 'food.image', 'carts.id')
        ->get();
    
        if ($cartData->isEmpty()) {
            return $this->index();
        } else {
            return view('showcart', compact('user_id','count', 'cartData'));
        }
    }

    public function removecart($id)
    {
        $data = cart::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function payment(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        if (is_null($paypalToken)) {
            return 'Unable to retrieve PayPal access token';
        }
        $formattedAmount = number_format((float)$request->total_amount, 2, '.', '');
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal_success'),
                "cancel_url" => route('paypal_cancel')
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $formattedAmount
                    ]
                ]
            ]
        ]);

        Log::debug('PayPal Order Response: ', $response);
        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] == 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('home')->with('error', 'Payment has been cancel due to some issues!');
        }
    }

    public function payPalSuccess(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->query('token'));
        Log::debug('PayPal Capture Response: ', $response);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return redirect()->route('home')->with('success', 'Payment has been done successfully!');
        } else {
            return redirect()->route('paypal_cancel');
        }
    }

    public function payPalCancel()
    {
        return redirect()->route('home')->with('error', 'Payment has been cancel due to some issues!');
    }

    public function stripe(Request $request)
    {
        $count = cart::where('user_id', $request->user_id)->count();
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

        foreach ($cartIds as $cartId) {        
            $orders = new Order;
            $orders->cart_id = $cartId;
            $orders->user_id = $request->user_id;
            $orders->status = 'paid';
            $orders->save();
        }
        return redirect()->route('home')->with('success', 'Payment has been done successfully!');
        }else{
            return redirect()->route('home')->with('error', 'Payment has been failed!');
        }
    }
}
