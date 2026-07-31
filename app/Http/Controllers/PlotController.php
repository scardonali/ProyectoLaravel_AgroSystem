<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plot;
use App\Models\Farm;

class PlotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plots = Plot::with('farm')->withCount('sowingsPlots')->get();
        return view('plots/index', compact('plots'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $farms = Farm::all();
        return view('plots/create', compact('farms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'area_hectares' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'string', 'max:255'],
            'farm_id' => ['required', 'exists:farms,id'],
        ]);

        $plot = new Plot;

        $plot->name = $validated['name'];
        $plot->area_hectares = $validated['area_hectares'];
        $plot->status = $validated['status'];
        $plot->farm_id = $validated['farm_id'];

        $plot->save();

        return redirect()->route('plots.index')->with('success', 'Lote creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // not implemented
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $plot = Plot::find($id);
        $farms = Farm::all();

        if (! $plot) {
            return redirect()->route('plots.index')->with('error', 'El lote no existe.');
        }

        return view('plots/edit', compact('plot', 'farms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $plot = Plot::find($id);

        if (! $plot) {
            return redirect()->route('plots.index')->with('error', 'El lote no existe.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'area_hectares' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'string', 'max:255'],
            'farm_id' => ['required', 'exists:farms,id'],
        ]);

        $plot->name = $validated['name'];
        $plot->area_hectares = $validated['area_hectares'];
        $plot->status = $validated['status'];
        $plot->farm_id = $validated['farm_id'];
        $plot->save();

        return redirect()->route('plots.index')->with('success', 'Lote actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $plot = Plot::find($id);

        if ($plot) {
            $plot->delete();
            return redirect()->route('plots.index')->with('success', 'Lote eliminado correctamente.');
        }

        return redirect()->route('plots.index')->with('error', 'El lote no existe.');
    }
}
