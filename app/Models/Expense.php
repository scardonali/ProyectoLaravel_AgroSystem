<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Sowing;
use App\Models\Supply;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'sowing_id',
        'supply_id',
        'quantity_used',
        'total_cost',
        'date',
        'description',
    ];

    public function sowing()
    {
        return $this->belongsTo(Sowing::class);
    }

    public function supply()
    {
        return $this->belongsTo(Supply::class);
    }
}