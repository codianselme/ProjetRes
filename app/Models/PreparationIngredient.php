<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreparationIngredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'preparation_id',
        'ingredient_name',
        'quantity',
        'unit',
        'preparation_id',
        'operateur',
    ];

    public function preparation()
    {
        return $this->belongsTo(Preparation::class);
    }
    
}
