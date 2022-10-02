<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributionDetails extends Model
{
    use HasFactory;

    protected $fillable = ['distribution_id', 'child_id', 'type'];
}
