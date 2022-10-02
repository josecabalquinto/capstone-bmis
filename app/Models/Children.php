<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    use HasFactory;

    protected $fillable = ['fullname', 'purok', 'caregiver', 'sex', 'age_in_months', 'purok_id', 'weight', 'height'];
}
