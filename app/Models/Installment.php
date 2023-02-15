<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Installment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ["users_id", "installment_number", "amount_installment", "interest_rate", "description"];

    protected $hidden = [];

    public function members() {
        $this->belongsTo(User::class, "users_id", "id");
    }

}
