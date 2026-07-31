<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Sowing;
use App\Models\Farm;
use App\Models\Harvest;

class ReporteController extends Controller
{

    public function gastosPorSiembra($id)
    {
        $sowing = Sowing::with(['expenses.supply', 'crop'])
            ->findOrFail($id);

        $total = $sowing->expenses->sum('total_cost');

        return Pdf::loadView('reportes.gastos', [
            'sowing' => $sowing,
            'total' => $total
        ])->stream('reporte-gastos.pdf');
    }
    public function cosechaIndividual($id)
{
    $harvest = Harvest::with(['sowing.crop'])
        ->findOrFail($id);

    $total = $harvest->quantity * $harvest->sale_price;

    $pdf = Pdf::loadView('reportes.cosechas', [
        'harvest' => $harvest,
        'total' => $total
    ]);

    return $pdf->stream('cosecha.pdf');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sowings = Sowing::with('crop')->get();

        return view('reportes.index', compact('sowings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
