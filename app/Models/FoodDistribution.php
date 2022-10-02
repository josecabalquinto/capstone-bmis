<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodDistribution extends Model
{
    use HasFactory;

    protected $fillable = ['purok_id', 'food_id', 'distributor', 'remarks', 'quantity'];
}
