<?php

namespace App\Http\Controllers;

use App\Models\PhysicalOrder;
use Illuminate\Http\Request;

class PhysicalOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $physicalOrders = PhysicalOrder::all();
        return view('admin.orders.physicalOrders.index', compact('physicalOrders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
          return view('admin.orders.physicalOrders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'paintCategory' => 'required|string|max:255',
            'paintType' => 'required|string|max:255',
            'capacity' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'paintcolor' => 'required|string|max:255',
            'needs_painter' => 'required|in:yes,no',
            'description' => 'nullable|string|max:1000',

            
        ]);

        $user = new PhysicalOrder();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->paintCategory = $request->paintCategory;
        $user->paintType = $request->paintType;
        $user->capacity = $request->capacity;
        $user->quantity = $request->quantity;
        $user->paintcolor = $request->paintcolor;
        $user->needs_painter = $request->needs_painter;
        $user->description = $request->description;
        $user->status = 'Pending';
        $res = $user->save();
        if($res){

               return redirect()->route('physicalOrders.index')->with('success', 'Painter added successfully.');
        }else{
           return back()->with('fail','Something Wrong');

        }
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
    public function edit(string $id)
    {
         $physicalOrder = PhysicalOrder::findOrFail($id);
        return view('admin.orders.physicalOrders.edit', compact('physicalOrder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $order = PhysicalOrder::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'paintCategory' => 'required|string|max:255',
        'paintType' => 'required|string|max:255',
        'capacity' => 'required|string|max:255',
        'quantity' => 'required|integer|min:1',
        'paintcolor' => 'required|string|max:255',
        'needs_painter' => 'required|in:yes,no',
        'description' => 'nullable|string|max:1000',


    ]);

    $order->update([
        'name' => $request->name,
        'phone' => $request->phone,
        'paintCategory' => $request->paintCategory,
        'paintType' => $request->paintType,
        'capacity' => $request->capacity,
        'quantity' => $request->quantity,
        'paintcolor' => $request->paintcolor,
        'needs_painter' => $request->needs_painter,
        'description' => $request->description,
        'status' => 'Pending', 
    ]);
    $order->save();

    return redirect()->route('physicalOrders.index')->with('success', 'Painter updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $order = PhysicalOrder::findOrFail($id);
    $order->delete();

    return redirect()->route('physicalOrders.index')->with('success', 'Painter deleted.');
    }

    public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:pending,approved,declined',
    ]);

    $order = PhysicalOrder::findOrFail($id);
    $order->status = $request->input('status');
    $order->save();

    return back()->with('success', 'Order status updated successfully.');

}
}