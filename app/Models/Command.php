<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'phone',
        'email',
        'delivery_address',
        'total_amount',
        'status',
    ];

    public function items()
    {
        return $this->hasMany(CommandItem::class);
    }
    
}
