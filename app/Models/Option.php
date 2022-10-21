<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ["min_saving", "min_saving_must", "min_loan", "interest_rate", "max_loan"];

    protected $hidden = [];

    public function savings() {
        return $this->hasOne(Saving::class, "", "id");
    }

    public function saving_musts() {
        return $this->hasOne(SavingMust::class, "", "id");
    }

    public function loans() {
        return $this->hasOne(Loan::class, "", "id");
    }

}
