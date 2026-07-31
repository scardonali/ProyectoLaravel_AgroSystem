<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Farm;
use App\Models\User;

class FarmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $farms = Farm::all();
        return view('farms/index', compact('farms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('farms/create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'total_hectares' => ['required', 'numeric', 'min:0'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $farm = new Farm;

        $farm->name = $validated['name'];
        $farm->location = $validated['location'];
        $farm->total_hectares = $validated['total_hectares'];
        $farm->user_id = $validated['user_id'];
        $farm->save();

        return redirect()->route('farms.index')->with('success', 'Finca creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
public function show(string $id)
{
    $farm = Farm::with(
        'user',
        'plots.sowingsPlots.sowing.crop'
    )->find($id);

    if (! $farm) {
        return redirect()
            ->route('farms.index')
            ->with('error', 'La finca no existe.');
    }

    // =========================
    // CLIMA OPENWEATHER
    // =========================

    $apiKey = env('OPENWEATHER_API_KEY');

    $city = $farm->location;

    $weatherUrl = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric&lang=es";

    $forecastUrl = "https://api.openweathermap.org/data/2.5/forecast?q={$city}&appid={$apiKey}&units=metric&lang=es";

    $weather = @json_decode(file_get_contents($weatherUrl), true);

    $forecast = @json_decode(file_get_contents($forecastUrl), true);

    // =========================
    // GASTOS VS COSECHAS
    // =========================

    $expenses = \App\Models\Expense::sum('total_cost');

    $harvests = \App\Models\Harvest::sum('sale_price');

    // =========================
    // STOCK INSUMOS
    // =========================

    $supplies = \App\Models\Supply::all();

    return view('farms.show', compact(
        'farm',
        'weather',
        'forecast',
        'expenses',
        'harvests',
        'supplies'
    ));
}

    /**    
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $farm = Farm::find($id);
        $users = User::all();

        if (! $farm) {
            return redirect()->route('farms.index')->with('error', 'La finca no existe.');
        }

        return view('farms/edit', compact('farm', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $farm = Farm::find($id);

        if (! $farm) {
            return redirect()->route('farms.index')->with('error', 'La finca no existe.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'total_hectares' => ['required', 'numeric', 'min:0'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $farm->name = $validated['name'];
        $farm->location = $validated['location'];
        $farm->total_hectares = $validated['total_hectares'];
        $farm->user_id = $validated['user_id'];
        $farm->save();

        return redirect()->route('farms.index')->with('success', 'Finca actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $farm = Farm::find($id);
        if ($farm) {
            $farm->delete();
            return redirect()->route('farms.index')->with('success', 'Finca eliminada correctamente con todos sus lotes.');
        }

        return redirect()->route('farms.index')->with('error', 'La finca no existe.');
    }
}
