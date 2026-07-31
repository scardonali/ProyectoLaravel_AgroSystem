<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Plot;
use App\Models\Sowing;

class SowingPlot extends Model
{
    protected $fillable = ['sowing_id', 'plot_id', 'sown_quantity', 'unit'];

    public function plot(){
       return $this->belongsTo(Plot::class);
    }

    public function sowing(){
       return $this->belongsTo(Sowing::class);
    }
}
