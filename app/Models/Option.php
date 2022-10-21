<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ["interest_rate", "time_period"];

    protected $hidden = [];

    public function loans() {
        return $this->hasOne(Loan::class, "option_id", "id");
    }

}
