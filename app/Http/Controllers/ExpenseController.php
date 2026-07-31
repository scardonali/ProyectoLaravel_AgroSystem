<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Sowing;
use App\Models\Supply;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::with(['sowing.crop', 'supply'])->get();

        return view('expenses.index', compact('expenses'));
    }

    public function create()
    {
        $sowings = Sowing::with(['crop', 'sowingsPlots.plot'])->get();
        $supplies = Supply::all();

        return view('expenses.create', compact('sowings', 'supplies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sowing_id' => 'required|exists:sowings,id',
            'supply_id' => 'required|exists:supplies,id',
            'quantity_used' => 'required|numeric',
            'total_cost' => 'required|numeric',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $expense = new Expense();

        $expense->sowing_id = $request->sowing_id;
        $expense->supply_id = $request->supply_id;
        $expense->quantity_used = $request->quantity_used;
        $expense->total_cost = $request->total_cost;
        $expense->date = $request->date;
        $expense->description = $request->description;

        $expense->save();

        return redirect()->route('expenses.index');
    }

    public function edit(string $id)
    {
        $expense = Expense::findOrFail($id);
        $sowings = Sowing::with(['crop', 'sowingsPlots.plot'])->get();
        $supplies = Supply::all();

        return view('expenses.edit', compact('expense', 'sowings', 'supplies'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'sowing_id' => 'required|exists:sowings,id',
            'supply_id' => 'required|exists:supplies,id',
            'quantity_used' => 'required|numeric',
            'total_cost' => 'required|numeric',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $expense = Expense::findOrFail($id);

        $expense->sowing_id = $request->sowing_id;
        $expense->supply_id = $request->supply_id;
        $expense->quantity_used = $request->quantity_used;
        $expense->total_cost = $request->total_cost;
        $expense->date = $request->date;
        $expense->description = $request->description;

        $expense->save();

        return redirect()->route('expenses.index');
    }

    public function destroy($id){
        $expense = Expense::findOrFail($id);
        $expense->delete();

        return redirect()->route('expenses.index')
            ->with('success', 'Gasto eliminado correctamente');
    }
}