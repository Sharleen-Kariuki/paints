<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\stockNeeded;
use App\Models\User;
use App\Notifications\OrderCompletedNotification;
use App\Services\GeminiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class ManufacturerController extends Controller
{
    public function pendingOrders()
{
     $data = null;
    
    if (Session::has('loginId')) {
        $data = User::where('id', Session::get('loginId'))->first();
    }
    $orders = Order::where('status', 'approved')
        ->orderBy('created_at', 'desc')
        ->get();
    
    $finishedOrdersCount = Order::where('status', 'completed')->count();

     
   //dd($orders);
    return view('manufacturer.orders.pending', compact('orders','data','finishedOrdersCount'));

}

public function finishedOrders()
{
    $data = null;
    
    if (Session::has('loginId')) {
        $data = User::where('id', Session::get('loginId'))->first();
    }
    $orders = Order::where('status', 'completed')
        ->orderBy('created_at', 'desc')
        ->get();
    
    $finishedOrdersCount = Order::where('status', 'completed')->count();

     
   //dd($orders);
    return view('manufacturer.orders.finished', compact('orders','data','finishedOrdersCount'));

}





public function markAsCompleted(Order $order)
{
    // Only allow marking orders that are approved
    if ($order->status !== 'approved') {
        return redirect()->back()->with('error', 'Only approved orders can be marked as completed.');
    }

    $order->status = 'completed'; // or 'finished'
    $order->save();

    // Notify the admin(s)
    $admins = User::where('role', 'admin')->get();
    Notification::send($admins, new OrderCompletedNotification($order));

    return redirect()->route('manufacturer.orders.pending')->with('success', 'Order marked as completed.');
}
public function index(Order $order){
    
    $materials = stockNeeded::all();
    

    return view('manufacturer.stockNeeded', compact('materials'));

}

public function storeMaterials(Request $request, Order $order)
{
    $validated = $request->validate([
        'materials.*.name' => 'required|string|max:255',
        'materials.*.quantity' => 'required|string|max:255', // you can make it numeric if needed
    ]);

    foreach ($validated['materials'] as $material) {
       $id = stockNeeded::create([
            'order_id' => $order->id,
            'material_name' => $material['name'],
            'quantity' => $material['quantity'],

        
        ]);
   
    }

    return redirect()->route('manufacturer.stockNeeded', $order->id)->with('success', 'Materials successfully added to the order.');
}
public function show(Order $order)
{
    // eager load materials
    $order->load('stockNeeded');

    return view('manufacturer.stockNeeded', compact('order'));
}

public function edit(string $id)
    {
        $material = stockNeeded::findOrFail($id);
        return view('manufacturer.edit', compact('material'));
    }
public function update(Request $request, $id)
{
    $material = stockNeeded::findOrFail($id);

    $request->validate([
        'material_name' => 'required|string|max:255',
        'quantity' => 'required|numeric',
        
    ]);

    $material->update([
        'material_name' => $request->material_name,
        'quantity' => $request->quantity,
    ]);

    return redirect()->route('manufacturer.stockNeeded')->with('success', 'Material updated successfully.');
}

 public function destroy($id)
{
    $material = stockNeeded::findOrFail($id);
    $material->delete();

    return redirect()->route('manufacturer.stockNeeded')->with('success', 'Material deleted.');
}

// In ManufacturerOrderController or a dedicated controller
public function suggestMaterials(Order $order)
{
    $geminiService = new GeminiService();
    $suggested = $geminiService->getPaintFormulaFromOrder($order);

     // Clean the response (remove triple quotes and code fences)
    $cleaned = preg_replace('/^```json|```|"""|\s*$/m', '', $suggested);
    $cleaned = trim($cleaned); // Just in case

        // First decode the Gemini response
     $decoded = json_decode($cleaned, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        dd('JSON decode error:', json_last_error_msg(), $cleaned);
    }

    $materials = $decoded['materials'] ?? [];

    // dd($materials); // For debugging, remove in production
    return view('manufacturer.material_suggestion', compact('order', 'materials'));
}


}
