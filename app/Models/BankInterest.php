<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankInterest extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ["members_id", "balance", ""];

}
