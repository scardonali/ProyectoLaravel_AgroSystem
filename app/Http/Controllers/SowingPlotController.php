<?php

namespace App\Http\Controllers;

use App\Models\SowingPlot;
use App\Models\Sowing;
use App\Models\Plot;
use Illuminate\Http\Request;

class SowingPlotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sowingPlots = SowingPlot::all();
        return view('sowing-plots.index', compact('sowingPlots'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sowings = Sowing::all();
        $plots = Plot::all();
        return view('sowing-plots.create', compact('sowings', 'plots'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sowing_id' => 'required|exists:sowings,id',
            'plot_id' => 'required|exists:plots,id',
            'sown_quantity' => 'required|numeric',
            'unit' => 'required|string|max:255',
        ]);

        $sowingPlot = new SowingPlot();
        $sowingPlot->sowing_id = $request->sowing_id;
        $sowingPlot->plot_id = $request->plot_id;
        $sowingPlot->sown_quantity = $request->sown_quantity;
        $sowingPlot->unit = $request->unit;
        $sowingPlot->save();

        return redirect()->route('sowings-plots.index')->with('success', 'Siembra-Lote creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(SowingPlot $sowingPlot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SowingPlot $sowingPlot)
    {
        $sowings = Sowing::all();
        $plots = Plot::all();
        return view('sowing-plots.edit', compact('sowingPlot', 'sowings', 'plots'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SowingPlot $sowingPlot)
    {
        $request->validate([
            'sowing_id' => 'required|exists:sowings,id',
            'plot_id' => 'required|exists:plots,id',
            'sown_quantity' => 'required|numeric',
            'unit' => 'required|string|max:255',
        ]);

        $sowingPlot->sowing_id = $request->sowing_id;
        $sowingPlot->plot_id = $request->plot_id;
        $sowingPlot->sown_quantity = $request->sown_quantity;
        $sowingPlot->unit = $request->unit;
        $sowingPlot->save();

        return redirect()->route('sowings-plots.index')->with('success', 'Siembra-Lote actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SowingPlot $sowingPlot)
    {
        $sowingPlot->delete();

        return redirect()->route('sowings-plots.index')->with('success', 'Siembra-Lote eliminada exitosamente');
    }
}
