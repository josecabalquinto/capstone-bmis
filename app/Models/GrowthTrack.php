<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrowthTrack extends Model
{
    use HasFactory;

    protected $fillable = ['child_id', 'age', 'weight', 'height', 'wfa', 'hfa', 'wfh'];
}
