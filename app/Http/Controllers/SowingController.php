<?php

namespace App\Http\Controllers;

use App\Models\Sowing;
use App\Models\Crop;
use Illuminate\Http\Request;

class SowingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sowings = Sowing::all();
        return view('sowings.index', compact('sowings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $crops = Crop::all();
        return view('sowings.create', compact('crops'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'crop_id' => 'required|exists:crops,id',
            'sowing_date' => 'required|date',
            'status' => 'required|string|max:255',
        ]);

        $sowing = new Sowing();
        $sowing->crop_id = $request->crop_id;
        $sowing->sowing_date = $request->sowing_date;
        $sowing->status = $request->status;
        $sowing->save();

        return redirect()->route('sowings.index')->with('success', 'Siembra creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sowing $sowing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sowing $sowing)
    {
        $crops = Crop::all();
        return view('sowings.edit', compact('sowing', 'crops'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sowing $sowing)
    {
        $validated = $request->validate([
            'crop_id' => 'required|exists:crops,id',
            'sowing_date' => 'required|date',
            'status' => 'required|string|max:255',
        ]);

        $sowing->crop_id = $request->crop_id;
        $sowing->sowing_date = $request->sowing_date;
        $sowing->status = $request->status;
        $sowing->save();

        return redirect()->route('sowings.index')->with('success', 'Siembra actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
public function destroy(Sowing $sowing)
{
    if ($sowing->sowingsPlots()->exists()) {
        return redirect()->route('sowings.index')
            ->with('error', 'No se puede eliminar esta siembra porque tiene lotes asociados.');
    }

    if ($sowing->harvests()->exists()) {
        return redirect()->route('sowings.index')
            ->with('error', 'No se puede eliminar esta siembra porque tiene cosechas asociadas.');
    }

    if ($sowing->expenses()->exists()) {
        return redirect()->route('sowings.index')
            ->with('error', 'No se puede eliminar esta siembra porque tiene gastos asociados.');
    }

    $sowing->delete();

    return redirect()->route('sowings.index')
        ->with('success', 'Siembra eliminada exitosamente.');
        }
}