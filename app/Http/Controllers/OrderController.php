<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    //Displays the user details to te admin
   public function store(Request $request)
   {
    // dd($request->all());
    $request->validate([
         
        'capacity' => 'required|string',
        'quantity' => 'required|integer',
        'paintcolor' => 'required|string',
        'needs_painter' => 'required|in:yes,no',
        'description' => 'nullable|string',
         

    ]);

    Order::create([
        'user_id' => session('loginId'), 
        'paintCategory' => $request->input('paintCategory'),
        'paintType' =>$request->input('paintType') ,
        'capacity' => $request->capacity,
        'quantity' => $request->quantity,
        'paintcolor' => $request->paintcolor,
        'needs_painter' => $request->needs_painter,
        'description' => $request->description,
        
        'status' => 'Pending',
    ]);

    return redirect()->route('order')->with('success', 'Order submitted successfully!');
     
 }


    public function showOrderForm($category,$type)
{
    $orders = Order::with('user')->orderBy('created_at', 'desc')->get();

    
    return view('admin.orders.onlineOrders', compact('orders','category', 'type'));
}


public function confirmOrder()
{
    $userId = session('loginId');

    $order = Order::with('user')
        ->where('user_id', $userId)
        ->latest()
        ->first();

    return view('confirmOrder', compact('order'));
}

public function savePhone(Request $request)
{
    $request->validate([
        'phone' => 'required|string|max:15',
    ]);

    $userId = session('loginId');

    $order = Order::where('user_id', $userId)->latest()->first();

    if ($order) {
        $order->phone = $request->phone;
        $order->save();
    }

    return redirect()->route('orderplaced')->with('success', 'Phone number saved and order placed!');
}
public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:pending,approved,declined',
    ]);

    $order = Order::findOrFail($id);
    $order->status = $request->input('status');
    $order->save();

    return back()->with('success', 'Order status updated successfully.');
}
public function showPendingOrders(Request $request)
{
    $orders = Order::with('user')
        ->where('status', 'pending')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('admin.orders.pendingOrders', compact('orders'));
}
public function showDeclinedOrders()
{
    $orders = Order::with('user')
        ->where('status', 'declined')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('admin.orders.declinedOrders', compact('orders'));
}
public function showApprovedOrders()
{
    $orders = Order::with('user')
        ->where('status', 'approved')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('admin.orders.approvedOrders', compact('orders'));
}



}
