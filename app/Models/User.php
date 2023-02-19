<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        "member_number",
        'email',
        'password',
        "place_of_birth",
        "date_of_birth",
        "phone_number",
        "gender",
        "position",
        "address",
        "amount_deposit"
    ];

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

    public function loans() {
        return $this->hasMany(Loan::class, "users_id", "id");
    }

    public function depositVoluntaries() {
        return $this->hasMany(DepositVoluntary::class, "users_id", "id");
    }

    public function depositMusts() {
        return $this->hasMany(DepositMust::class, "users_id", "id");
    }

    public function surpluses(){
        return $this->hasMany(Surplus::class, "users_id", "id");
    }
}
