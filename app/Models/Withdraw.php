<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ["members_id", "amount_withdraw", "description", "due_date"];

    protected $hidden = [];

    public function members() {
        return $this->belongsTo(Member::class, "users_id", "id");
    }
}
