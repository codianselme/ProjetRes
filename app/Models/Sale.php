<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'invoice_number',
        'total_amount',
        'paid_amount',
        'payment_method',
        'status',
        'notes',
    ];

    /**
     * Relation : Une vente a plusieurs articles.
     */
    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }
}
