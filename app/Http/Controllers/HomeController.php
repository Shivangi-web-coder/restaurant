<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use App\models\Food;
use App\models\FoodChef;
use App\models\Cart;
use App\models\Order;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
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
            $count = Cart::where('user_id', $user_id)->count();
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
            $count = cart::where('user_id', $user_id)->count();
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
        $count = Cart::where('user_id', $user_id)->count();
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
        ->groupBy('carts.food_id', 'food.title', 'food.description', 'food.price', 'food.image', 'carts.id')
        ->get();
       
        if ($cartData->isEmpty()) {
            return $this->index();
        } else {
            return view('showcart', compact('count', 'cartData'));
        }
    }

    public function removecart($id)
    {
        $data = cart::find($id);
        $data->delete();
        return redirect()->back();
    }

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

    public function processTransaction(Request $request)
    {
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
    
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction'),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $request->amount
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('createTransaction')
                ->with('error', 'Something went wrong.');
        } else {
            return redirect()
                ->route('createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return redirect()
                ->route('createTransaction')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function cancelTransaction(Request $request)
    {
        return redirect()
            ->route('createTransaction')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }
}
