<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrinkSupply extends Model
{
    use HasFactory;

    /**
     * Le nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'drink_supplies';

    /**
     * Les attributs qui peuvent être remplis de manière massive.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'drink_name',
        'unit',
        'supplier_name',
        'quantity',
        'unit_price',
        'total_cost',
        'supply_date',
    ];

    /**
     * Les attributs qui doivent être castés à un type natif.
     *
     * @var array
     */
    protected $casts = [
        'supply_date' => 'date',
        'unit_price' => 'float',
        'total_cost' => 'float',
        'quantity' => 'integer',
    ];

    /**
     * Relation : Un approvisionnement appartient à une catégorie de boisson.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(DrinkCategory::class, 'category_id');
    }

    /**
     * Calcul du coût total de l'approvisionnement.
     *
     * @return float
     */
    public function calculateTotalCost()
    {
        return $this->quantity * $this->unit_price;
    }
}
