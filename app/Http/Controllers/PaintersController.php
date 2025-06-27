<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Painter; 

class PaintersController extends Controller
{
    

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $painters = Painter::all();
        return view('admin.painters.index', compact('painters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.painters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'National_ID' => 'required|string|unique:painters,National_ID|max:20',
            'address' => 'required|string|max:255',
        ]);

        $user =new Painter();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->National_ID = $request->National_ID;
        $user->address = $request->address;
        $res = $user->save();
        if($res){

               return redirect()->route('painters.index')->with('success', 'Painter added successfully.');
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
        $painter = Painter::findOrFail($id);
        return view('admin.painters.edit', compact('painter'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $id)
{
    $painter = Painter::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'National_ID' => 'required|string|max:20|unique:painters,National_ID,' . $painter->id,
        'address' => 'required|string|max:255',
    ]);

    $painter->update([
        'name' => $request->name,
        'phone' => $request->phone,
        'National_ID' => $request->National_ID,
        'address' => $request->address,
    ]);

    return redirect()->route('painters.index')->with('success', 'Painter updated successfully.');
}




    /**
     * Remove the specified resource from storage.
     */
 public function destroy($id)
{
    $painter = Painter::findOrFail($id);
    $painter->delete();

    return redirect()->route('painters.index')->with('success', 'Painter deleted.');
}

}
