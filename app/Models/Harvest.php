<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Sowing;

class Harvest extends Model
{
    use HasFactory;

    protected $fillable = [
        'sowing_id',
        'quantity',
        'unit',
        'sale_price',
        'date',
    ];

    public function sowing()
    {
        return $this->belongsTo(Sowing::class);
    }
}