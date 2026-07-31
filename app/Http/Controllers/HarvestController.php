<?php

namespace App\Http\Controllers;
use App\Models\Harvest;
use App\Models\Sowing;
use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Support\Facades\DB;

class HarvestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
    {

        $harvests = Harvest::with(
            'sowing.crop',
            'sowing.sowingsPlots.plot'
        )->get();


        // =========================
        // GASTOS
        // =========================

        $expenses =
            Expense::sum('total_cost');


        // =========================
        // GANANCIAS COSECHAS
        // =========================

        $harvestProfit =
             Harvest::sum('sale_price');


        return view(

            'harvests.index',

            compact(
                'harvests',
                'expenses',
                'harvestProfit'
            )

        );

}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sowings = Sowing::with(['crop', 'sowingsPlots.plot'])->get();

        return view('harvests.create', compact('sowings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
        'sowing_id' => 'required|integer',
        'quantity' => 'required|numeric',
        'unit' => 'required|string|max:50',
        'sale_price' => 'required|numeric',
        'date' => 'required|date',
    ]);

        $harvest = new Harvest();
        $harvest->sowing_id = $request->sowing_id;
        $harvest->quantity = $request->quantity;
        $harvest->unit = $request->unit;
        $harvest->sale_price = $request->sale_price;
        $harvest->date = $request->date;

        $harvest->save();

        return redirect()->route('harvests.index');
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
        $harvest = Harvest::findOrFail($id);
        $sowings = Sowing::with(['crop', 'sowingsPlots.plot'])->get();

        return view('harvests.edit', compact('harvest', 'sowings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $request->validate([
        'sowing_id' => 'required|integer',
        'quantity' => 'required|numeric',
        'unit' => 'required|string|max:50',
        'sale_price' => 'required|numeric',
        'date' => 'required|date',
    ]);

    $harvest = Harvest::findOrFail($id);

    $harvest->sowing_id = $request->sowing_id;
    $harvest->quantity = $request->quantity;
    $harvest->unit = $request->unit;
    $harvest->sale_price = $request->sale_price;
    $harvest->date = $request->date;

    $harvest->save();

    return redirect()->route('harvests.index');
}


    public function destroy(string $id)
{
    $harvest = Harvest::findOrFail($id);

    $harvest->delete();

    return redirect()->route('harvests.index')
        ->with('success', 'Cosecha eliminada correctamente');
}
}
