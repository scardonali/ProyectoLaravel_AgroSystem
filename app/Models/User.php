<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\Role;
use App\Models\Farm;

use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['name', 'email', 'password', 'role_id', 'farm_id'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{

    use hasFactory;

    use softDeletes;

    use Notifiable;

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function farms(){
       return $this->hasMany(Farm::class);
    }

    public function farm(){
        return $this->belongsTo(Farm::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
