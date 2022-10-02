<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VitaminDistribution extends Model
{
    use HasFactory;

    protected $fillable = ['distributor', 'remarks', 'purok_id', 'vitamin_id'];
}
