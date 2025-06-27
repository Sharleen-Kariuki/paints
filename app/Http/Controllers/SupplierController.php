<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
  
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('admin.suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('admin.suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'Company_name' => 'required|string|max:255',
        'phone' => 'nullable|string|max:15',
        'address' => 'required|string|max:255',
        'material_bought' => 'required|string|max:255',
        'amount_paid' => 'required|numeric',
        'quantity' => 'required|numeric',
        'unit_price' => 'required|numeric',
    ]);

    $supplier = new Supplier();
    $supplier->Company_name = $request->Company_name;
    $supplier->phone = $request->phone;
    $supplier->address = $request->address;
    $supplier->material_bought = $request->material_bought;
    $supplier->amount_paid = $request->amount_paid;
    $supplier->quantity = $request->quantity;
    $supplier->unit_price = $request->unit_price;

    if ($supplier->save()) {
        return redirect()->route('suppliers.index')->with('success', 'Supplier added successfully.');
    } else {
        return back()->with('fail', 'Something went wrong.');
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
        $supplier = Supplier::findOrFail($id);
        return view('admin.suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $supplier = Supplier::findOrFail($id);

    $request->validate([
        'Company_name' => 'required|string|max:255',
        'phone' => 'string|max:20',
        'address' => 'required|string|max:255',
        'material_bought' => 'required|string|max:255',
        'amount_paid' => 'required|numeric',
        'quantity' => 'required|numeric',
        'unit_price' => 'required|numeric',

    ]);

    $supplier->update([
        'Company_name' => $request->Company_name,
        'phone' => $request->phone,
        'address' => $request->address,
        'material_bought' => $request->material_bought,
        'amount_paid' => $request->amount_paid,
        'quantity' => $request->quantity,
        'unit_price' => $request->unit_price,
    ]);

    return redirect()->route('suppliers.index')->with('success', 'Painter updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::findOrFail($id);
    $supplier->delete();

    return redirect()->route('suppliers.index')->with('success', 'Painter deleted.');
    }
}
