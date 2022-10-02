<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeightForAge extends Model
{
    use HasFactory;

    protected $fillable = ['age', 'ss', 's_fr', 's_to', 'n_fr', 'n_to', 'tall', 'gender'];
}
