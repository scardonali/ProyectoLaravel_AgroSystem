<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use App\Models\Sowing;

class Crop extends Model
{
    use HasFactory;
    protected $fillable = ['type', 'variety', 'description'];

    public function sowings(){
       return $this->hasMany(Sowing::class);
    }
}
