<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrinkStock extends Model
{
    use HasFactory;

    protected $fillable = ['drink_name', 'quantity', 'unit_price', 'total_cost'];

    
}
