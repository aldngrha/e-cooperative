<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ["users_id", "place_of_birth", "date_of_birth",
        "phone_number", "gender", "position", "address"];

    protected $hidden = [];

    public function users() {
        return $this->belongsTo(User::class, "users_id", "id");
    }

    public function balances() {
        return $this->hasOne(Saving::class, "members_id", "id");
    }

    public function withdraws() {
        return $this->hasMany(Withdraw::class, "members_id", "id");
    }

    public function deposits() {
        return $this->hasMany(Deposit::class, "members_id", "id");
    }
}
