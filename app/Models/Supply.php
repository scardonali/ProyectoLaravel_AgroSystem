<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Expense;

class Supply extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'unit_of_measure',
        'current_stock',
        'minimum_stock',
        'unit_price',
    ];

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}