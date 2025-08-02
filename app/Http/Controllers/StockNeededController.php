<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Order;
use App\Models\stockNeeded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;


class StockNeededController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Order $order)
    {
        $order_id = $order->id; 
        $stockNeeded = stockNeeded::where('order_id', $order_id)->get();
         

        return view('manufacturer.stockNeeded.index', compact('stockNeeded', 'order_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
public function create(Request $request, Order $order)
{   
    $order_id = $order->id; 
    return view('manufacturer.stockNeeded.create', compact('order_id'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Order $order)
    {
        
        
        $request->validate([
            'material_name' => 'required|string|max:255',
            'quantity' => 'required|string',
        ]);

        // Extract numeric quantity for checks and subtraction
        $numericQuantity = preg_replace('/\D/', '', $request->quantity);

        // Find the material in inventory
        $material = Material::where('name', $request->material_name)->first();

        // Check if material exists
        if (!$material) {
            $errorMsg = 'Material not found in inventory.';
            if ($request->expectsJson()) {
            return response()->json(['success' => false, 'message' => $errorMsg], 404);
            }
            return back()->with('error', $errorMsg);
        }

        // Check if enough material is available
        if ($material->stock_qty < $numericQuantity) {
            $errorMsg = 'Insufficient material in inventory.';
            if ($request->expectsJson()) {
            return response()->json(['success' => false, 'message' => $errorMsg], 422);
            }
            return back()->with('error', $errorMsg);
        }

        // Deduct from inventory
        $material->stock_qty -= $numericQuantity;
        $material->save();

        $stockNeeded = new StockNeeded();
        $stockNeeded->order_id = $order->id;
        $stockNeeded->material_name = $request->material_name;
        // Save quantity with units as entered
        $stockNeeded->quantity = $request->quantity;
        $stockNeeded->save();

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('stockNeeded.index', ['order' => $order->id])->with('success', 'Material added successfully.');
        }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order,string $id, )
    {
        
        $stockNeeded = stockNeeded::findOrFail($id);
      
        return view('manufacturer.stockNeeded.edit', compact('stockNeeded', 'order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order, string $id)
    {
        $order_id = $order->id;
        $stockNeeded = stockNeeded::findOrFail($id);

        $request->validate([
            'material_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
        ]);

        $stockNeeded->update([
            'material_name' => $request->material_name,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('stockNeeded.index',['order' => $order_id])->with('success', 'Material updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order,string $id,)
    {
        $order_id = $order->id;
        $stockNeeded = stockNeeded::findOrFail($id);
        $stockNeeded->delete();

        return redirect()->route('stockNeeded.index', ['order' => $order_id])->with('success', 'Material deleted successfully.');
    }
}
