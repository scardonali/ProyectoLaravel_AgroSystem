<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Harvest;
use App\Models\Supply;

class WeatherController extends Controller
{
    public function index()
{

    // =========================
    // GASTOS
    // =========================

    $expenses = Expense::sum('total_cost');


    // =========================
    // COSECHAS
    // =========================

    $harvests = Harvest::sum('sale_price');


    // =========================
    // INSUMOS
    // =========================

    $supplies = Supply::all();


    return view(
        'weather',
        compact(
            'expenses',
            'harvests',
            'supplies'
        )
    );
}
}
