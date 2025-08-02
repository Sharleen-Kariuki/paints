<?php

namespace App\Http\Controllers;


use App\Events\ApprovedOrder;
use App\Events\OrderPlaced;
use App\Models\FormulaIngredients;
use App\Models\Ingredients;
use App\Models\Order;
use App\Models\ProductFormulas;
use App\Models\Setting;
use App\Models\User;
use App\Models\Invoice;
use App\Services\GeminiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;



class OrderController extends Controller
{
    //Displays the user details to the admin
   public function store(Request $request)
   {
    $request->validate([
        'name' => 'string|max:255',
        'phone' => 'string|max:15',
        'paintCategory' => 'string|max:255',
        'paintType' => 'string|max:255',
        'capacity' => 'required|string',
        'quantity' => 'required|integer',
        'paintcolor' => 'required|string',
        'order_type' => 'required|in:online,physical',
        
    ]);

    $capacity = (float) $request->capacity;
   
    $quantity = (int) $request->quantity;
   
    $pricePerLitre = (float) Setting::where('key','price_per_litre')->value('value');

    $total_price = $capacity * $quantity * $pricePerLitre;


    $order = Order::create([
        'user_id' => session('loginId'),
        'name' => $request->input('name', null),
        'phone' => $request->input('phone', null), 
        'paintCategory' => $request->input('paintCategory'),
        'paintType' =>$request->input('paintType') ,
        'capacity' => $request->capacity,
        'quantity' => $request->quantity,
        'paintcolor' => $request->paintcolor,
        'needs_painter' => $request->needs_painter,
        'description' => $request->description,
        'order_type' => $request->order_type,
        'status' => $request->status,
         'total_price' => $total_price,
    ]);

//loads the relationship with the user
$order->load('user');

    //trigger order placed event
     event(new OrderPlaced($order));


    return redirect()->route('order')->with('success', 'Order submitted successfully!');
     
 }

//user - order relationship to display the orders
public function showOrderForm($category, $type)
{
    $orders = Order::with('user')->orderBy('created_at', 'desc')->get();

 
    return view('admin.orders.onlineOrders', compact('orders', 'category', 'type'));
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

    // Trigger event when order is approved
    if ($order->status === 'approved') {
        event(new ApprovedOrder($order));
    }

    return back()->with('success', 'Order status updated successfully.');
}
public function showPendingOrders(Request $request)
{
    $orders = Order::where('status', 'pending')
        ->orderBy('created_at', 'desc')
        ->get();


    return view('admin.orders.pendingOrders', compact('orders'));
}
public function showDeclinedOrders()
{
    $orders = Order::where('status', 'declined')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('admin.orders.declinedOrders', compact('orders'));
}
public function showApprovedOrders()
{
     $data = null;
    
    if (Session::has('loginId')) {
        $data = User::where('id', Session::get('loginId'))->first();
    }
    $orders = Order::where('status', 'approved')
        ->orderBy('created_at', 'desc')
        ->get();



    return view('admin.orders.approvedOrders', compact('data','orders'));
}

public function showFinishedOrders()
{
    $orders = Order::where('status', 'completed')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('admin.orders.finished', compact('orders'));
}

public function myOrders()
{
    $userId = session('loginId');

    $orders = Order::where('user_id', $userId)
        ->orderBy('created_at', 'desc')
        ->get();

        //dd($orders);
    return view('mycart', compact('orders'));
}
public function destroy($id)
{
    $order = Order::findOrFail($id);
    $order->delete();

    return redirect()->route('myOrders')->with('success', 'Order deleted successfully.');
}


public function showFormula($id, GeminiService $gemini)
{
    $order = Order::findOrFail($id);
    $formulaJson = $gemini->getPaintFormulaFromOrder($order);

 
    // Optionally decode if response is JSON
    $formula = json_decode($formulaJson, true);

        // Optional: check if decoding failed
    if (json_last_error() !== JSON_ERROR_NONE) {
        return back()->with('error', 'Invalid AI response');
    }

    // dd($formulaJson);
    return view('orders.formula', compact('order', 'formulaJson'));
}



public function generateInvoicePDF($orderId)
{
    $Order = Order::findOrFail($orderId);
    

    $pdf = Pdf::loadView('invoice.pdf', compact('Order'));
    return view('invoice.pdf', compact('Order'));

    // Option 2: Save and email it
    // Storage::put("invoices/{$fileName}", $pdf->output());
}
// public function generateInvoiceStatementPDF()
// {
//     $userId = session('loginId');
//     $orders = Order::where('user_id', $userId)
//         ->where('status', 'paid')
//         ->orderBy('created_at', 'desc')
//         ->get();

//     if ($orders->isEmpty()) {
//         return back()->with('error', 'No paid orders found for the user.');
//     }

//     $pdf = Pdf::loadView('invoice.statement', compact('orders'));
    
//     // Option 1: Directly return the PDF view
//     return view('invoice.statement', compact('orders'));

// }
}
