<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Plot;


class Farm extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'name', 'location', 'total_hectares'];

    protected static function booted(): void
    {
        static::deleting(function (Farm $farm) {
            if (! $farm->isForceDeleting()) {
                $farm->plots()->delete();
            }
        });
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function plots(){
       return $this->hasMany(Plot::class);
    }
}
