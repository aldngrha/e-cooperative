<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saving extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ["users_id", "deposit_id", "amount_save", "description"];

    protected $hidden = [];

    public function members() {
        return $this->belongsTo(User::class, "users_id", "id");
    }

    public function deposits() {
        return $this->belongsTo(Option::class, "option_id", "id");
    }
}
