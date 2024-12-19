<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preparation extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'quantity_used', 'ingredients', 'is_completed'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
