<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use App\Models\SowingPlot;
use App\Models\Harvest;
use App\Models\Expense;
use App\Models\Crop;

class Sowing extends Model
{
    use HasFactory;
    protected $fillable = ['crop_id', 'sowing_date', 'status'];

    public function sowingsPlots(){
       return $this->hasMany(SowingPlot::class);
    }

    public function harvests(){
       return $this->hasMany(Harvest::class);
    }

    public function expenses(){
       return $this->hasMany(Expense::class);
    }

    public function crop(){
        return $this->belongsTo(Crop::class);
    }

}
