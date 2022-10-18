<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saving extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ["members_id", "amount_save", "description"];

    protected $hidden = [];

    public function members() {
        return $this->belongsTo(Member::class, "members_id", "id");
    }

}
