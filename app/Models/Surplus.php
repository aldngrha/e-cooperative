<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Surplus extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ["users_id", "withdraw", "status"];

    protected $hidden = [];

    public function members() {
        return $this->belongsTo(User::class, "users_id", "id");
    }

}
