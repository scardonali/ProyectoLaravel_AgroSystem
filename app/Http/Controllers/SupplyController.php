<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supply;

class SupplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplies = Supply::all();

        return view('supplies.index', compact('supplies'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supplies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $supply = new Supply();

        $supply->name = $request->name;
        $supply->type = $request->type;
        $supply->unit_of_measure = $request->unit_of_measure;
        $supply->current_stock = $request->current_stock;
        $supply->minimum_stock = $request->minimum_stock;
        $supply->unit_price = $request->unit_price;

        $supply->save();

        return redirect()->route('supplies.index');
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
        $supply = Supply::findOrFail($id);
        return view('supplies.edit', compact('supply'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $supply = Supply::findOrFail($id);

        $supply->name = $request->name;
        $supply->type = $request->type;
        $supply->unit_of_measure = $request->unit_of_measure;
        $supply->current_stock = $request->current_stock;
        $supply->minimum_stock = $request->minimum_stock;
        $supply->unit_price = $request->unit_price;

        $supply->save();

        return redirect()->route('supplies.index');
    }

    /**
     * Remove the specified resource from storage.
     */
public function destroy(string $id)
{
    $supply = Supply::findOrFail($id);

    if ($supply->expenses()->exists()) {
        return redirect()->route('supplies.index')
            ->with('error', 'No se puede eliminar este insumo porque tiene gastos asociados.');
    }

    $supply->delete();

    return redirect()->route('supplies.index')
        ->with('success', 'Insumo eliminado correctamente.');
    }
}