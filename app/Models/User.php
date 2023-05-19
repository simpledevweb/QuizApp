<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'phone',
        'is_premium',
        'is_admin', 
        'email',
        'password',
    ];
    //relationships

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public function collections():HasMany
    {
        return $this->hasMany(Collection::class);
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn(string $value)=>Hash::make($value)
        );
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn(string $value)=>strtolower($value),
            get: fn(string $value)=>ucwords($value),
        );
    }

    protected function nameAndphone(): Attribute
    {
        return Attribute::make(
            get: fn()=>$this->name." ".$this->phone
        );
    }
}
