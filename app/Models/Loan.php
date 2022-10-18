<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ["members_id", "amount_loan", "due_date", "description"];

    protected $hidden = [];

    public function members() {
        $this->belongsTo(Member::class, "members_id", "id");
    }
}
