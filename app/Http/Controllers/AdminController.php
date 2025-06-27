<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{public function viewOnlineOrders()
{
    $orders = Order::with('user')
        ->where('order_type', 'online')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('admin.orders.onlineOrders', compact('orders'));
}

public function viewPhysicalOrders()
{
    $orders = Order::with('user')
        ->where('order_type', 'physical')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('admin.orders.physicalOrders', compact('orders'));
}

}
