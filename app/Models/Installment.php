<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Installment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ["users_id", "loans_id","installment_number", "amount_installment", "interest_rate", "remaining", "description"];

    protected $hidden = [];

    public function loans() {
        return $this->belongsTo(Loan::class, "loans_id", "id");
    }
}
