<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use Illuminate\Http\Request;

class CropController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $crops = Crop::all();
        return view('crops.index', compact('crops'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('crops.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'variety' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $crop = new Crop();
        $crop->type = $request->type;
        $crop->variety = $request->variety;
        $crop->description = $request->description;
        $crop->save();

        return redirect()->route('crops.index')->with('success', 'Cultivo creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Crop $crop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Crop $crop)
    {
        return view('crops.edit', compact('crop'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Crop $crop)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'variety' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $crop->type = $request->type;
        $crop->variety = $request->variety;
        $crop->description = $request->description;
        $crop->save();

        return redirect()->route('crops.index')->with('success', 'Cultivo actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Crop $crop)
    {
        if ($crop->sowings()->count() > 0) {
            return redirect()->route('crops.index')->with('error', 'No se puede eliminar este cultivo porque tiene siembras asociadas');
        }

        $crop->delete();

        return redirect()->route('crops.index')->with('success', 'Cultivo eliminado exitosamente');
    }
}
