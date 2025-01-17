<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'dish_name',
        'quantity',
        'price',
        'notes',
        'command_id',
    ];

    public function command()
    {
        return $this->belongsTo(Command::class);
    }

    // public function dish()
    // {
    //     return $this->belongsTo(Dish::class);
    // }
}
