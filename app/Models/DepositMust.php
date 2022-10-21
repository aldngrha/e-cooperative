<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepositMust extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ["users_id", "option_id", "amount_deposit", "description"];

    protected $hidden = [];

    public function members() {
        return $this->belongsTo(User::class, "users_id", "id");
    }

    public function options() {
        return $this->belongsTo(Option::class, "option_id", "id");
    }

}
