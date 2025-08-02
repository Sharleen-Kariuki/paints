<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
public function viewOnlineOrders()
{
    $orders = Order::with('user')
        ->where('order_type', 'online')
        ->orderBy('created_at', 'desc')
        ->get();

       

    return view('admin.orders.onlineOrders', compact('orders'));
}

public function viewPhysicalOrders()
{
    
    $orders = Order::where('order_type', 'physical')
        ->orderBy('created_at', 'desc')
        ->get();

  

    return view('admin.orders.physicalOrders.index', compact('orders'));
}

//viewing the users
 public function viewUsers()
    {
        $users = User::all();
        return view('admin.Users.index', compact('users'));
    }

    public function updateRole(Request $request, $id)
{
    $request->validate([
        'role' => 'required|in:user,admin,manufacturer',
    ]);

    $user = User::findOrFail($id);
    $user->role = $request->input('role');
    $user->save();

    return back()->with('success', 'Role updated successfully.');
}
public function showPriceSetting()
{
    $price = Setting::where('key', 'price_per_litre')->value('value');
    return view('admin.settings', compact('price'));
}

public function updatePrice(Request $request)
{
    $request->validate(['price' => 'required|numeric|min:0']);
    
    Setting::updateOrCreate(
        ['key' => 'price_per_litre'],
        ['value' => $request->price]
    );

    return back()->with('success', 'Price updated!');
}


}
