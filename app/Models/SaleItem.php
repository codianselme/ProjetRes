<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaleItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'itemable_id',
        'itemable_type',
        'quantity',
        'unit_price',
        'total_price',
        'sale_id',
    ];

    /**
     * Relation polymorphe pour les plats et boissons.
     */
    public function itemable()
    {
        return $this->morphTo();
    }

    /**
     * Relation avec la vente.
     */
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
