<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Capital extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ["surplus_id", "amount_capital", "description"];

    protected $hidden = [];

    public function withdraws() {
        return $this->belongsTo(Surplus::class, "surplus_id", "id");
    }
}
