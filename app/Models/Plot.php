<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Farm;
use App\Models\SowingPlot;


class Plot extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'area_hectares', 'status', 'farm_id', 'is_active', 'deactivation_reason', 'deactivated_at'];
    
    public function farm(){
        return $this->belongsTo(Farm::class);
    }

    public function sowingsPlots(){
       return $this->hasMany(SowingPlot::class);
    }

}
