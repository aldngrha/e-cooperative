<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavingMust extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ["users_id", "deposit_must_id", "amount_save", "description"];

    protected $hidden = [];

    public function members() {
        return $this->belongsTo(User::class, "users_id", "id");
    }

    public function depositMusts() {
        return $this->belongsTo(Option::class, "option_id", "id");
    }

}
