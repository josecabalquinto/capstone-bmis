<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightForHeight extends Model
{
    use HasFactory;

    protected $fillable = ['length', 'sw', 'w_fr', 'w_to', 'n_fr', 'n_to', 'ow_fr', 'ow_to', 'o', 'gender'];
}
