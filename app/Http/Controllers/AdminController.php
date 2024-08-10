<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\models\User;
use App\models\Food;
use App\models\Reservation;
use App\models\FoodChef;
use App\models\Order;

class AdminController extends Controller
{
    public function user()
    {
        $data = user::all();
        return view("admin.users", compact("data"));
    }

    public function deleteuser($id)
    {
        $data = user::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function foodmenu()
    {
        $data = food::all();
        return view("admin.foodmenu", compact("data"));
    }

    public function uploadmenu(Request $request)
    {
        $data = new food;
        $file = $request->file('image');
        $imagename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('foodimage'), $imagename);
        $data->image = $imagename;
        $data->title = $request->title;
        $data->price = $request->price;
        $data->description = $request->description;
        $data->save();
        return redirect()->back();
    }

    public function deletemenu($id)
    {
        $data = food::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function editmenu($id)
    {
        $data = food::find($id);
        return view('admin.updatemenu', compact('data'));
    }

    public function updatemenu(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $data = food::find($request->id);
        if ($request->hasFile('image')) {
            if ($data->image) {
                Storage::delete('public/foodimage/' . $data->image);
            }
            $file = $request->file('image');
            $imagename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('foodimage'), $imagename);
            $data->image = $imagename;
        }
        $data->title = $request->title;
        $data->price = $request->price;
        $data->description = $request->description;
        $data->save();
        return redirect()->back();
    }

    public function reservation(Request $request)
    {
        $data = new reservation;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->guest = $request->guest;
        $data->date = $request->date;
        $data->time = $request->time;
        $data->message = $request->message;
        $data->save();
        return redirect()->back();
    }

    public function adminreservation()
    {
        $data = reservation::all();
        return view("admin.adminreservation", compact("data"));
    }

    public function foodchef()
    {
        $data = foodchef::all();
        return view("admin.foodchef", compact('data'));
    }

    public function uploadchef(Request $request)
    {
        $data = new foodchef;
        $file = $request->file('image');
        $imagename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('chefimage'), $imagename);
        $data->image = $imagename;
        $data->name = $request->name;
        $data->speciality = $request->speciality;
        $data->save();
        return redirect()->back();
    }

    public function deletechef($id)
    {
        $data = foodchef::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function editchef($id)
    {
        $data = foodchef::find($id);
        return view('admin.updatechef', compact('data'));
    }

    public function updatechef(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $data = foodchef::find($request->id);
        if ($request->hasFile('image')) {
            if ($data->image) {
                $path = 'chefimage/' . $data->image;
                $absolutePath = public_path($path);

                if (file_exists($absolutePath)) {
                    unlink($absolutePath);
                }
            }
            $file = $request->file('image');
            $imagename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('chefimage'), $imagename);
            $data->image = $imagename;
        }
        $data->name = $request->name;
        $data->speciality = $request->speciality;
        $data->save();
        return redirect()->back();
    }

    public function orders()
    {
        return view('admin.orders');
    }

    public function fetch_orders(Request $request)
    {
        $orderData = Order::select(
            'orders.id',
            'users.name',
            'users.email',
            'users.phone',
            'users.address',
            'food.title as foodname',
            'food.price',
            'orders.quantity as total_quantity'
        )->join('users','users.id','orders.user_id')
        ->join('food', 'orders.food_id','food.id');
        if(!empty($request->search)){
            $orderData =$orderData->where('users.name', 'Like', '%' . $request->search . '%')
            ->orWhere('users.email', 'Like', '%' . $request->search . '%')
            ->orWhere('users.phone', 'Like', '%' . $request->search . '%')
            ->orWhere('users.address', 'Like', '%' . $request->search . '%')
            ->orWhere('food.title', 'Like', '%' . $request->search . '%')
            ->orWhere('food.price', 'Like', '%' . $request->search . '%');
        }

        $orderData =$orderData->get()->groupBy('user_id');
        return view('admin.order_list', compact('orderData'));
    }
}
