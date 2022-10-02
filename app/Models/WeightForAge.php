<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightForAge extends Model
{
    use HasFactory;

    protected $fillable = ['age', 'su', 'u_fr', 'u_to', 'n_fr', 'n_to', 'o', 'gender'];
}
