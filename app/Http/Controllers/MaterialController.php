<?php

namespace App\Http\Controllers;

  use App\Models\Material;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::all();
         $data = null;
    
    if (Session::has('loginId')) {
        $data = User::where('id', Session::get('loginId'))->first();
    }
        return view('manufacturer.materials.index', compact('materials','data'));
    }

    public function create()
    {
        return view('manufacturer.materials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'unit' => 'required',
            'stock_qty' => 'required|numeric',
            'reorder_level' => 'required|numeric',
        ]);

        Material::create($request->all());
        return redirect()->route('materials.index')->with('success', 'Material created successfully.');
    }

    public function edit(Material $material)
    {
         $data = null;
    
    if (Session::has('loginId')) {
        $data = User::where('id', Session::get('loginId'))->first();
    }
        return view('manufacturer.materials.edit', compact('material', 'data'));
    }

    public function update(Request $request, Material $material)
    {
        $request->validate([
            'name' => 'required',
            'unit' => 'required',
            'stock_qty' => 'required|numeric',
            'reorder_level' => 'required|numeric',
        ]);

        $material->update($request->all());
        return redirect()->route('materials.index')->with('success', 'Material updated.');
    }
}

