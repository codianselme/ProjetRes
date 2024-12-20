<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DishCategory extends Model
{

    use HasFactory, SoftDeletes;

    /**
     * Le nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'dish_categories';

    /**
     * Les attributs qui peuvent être remplis de manière massive.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'is_active',
        'operateur',
    ];

    /**
     * Les attributs qui doivent être castés à un type natif.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Relation : Une catégorie peut avoir plusieurs boissons.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dishes()
    {
        return $this->hasMany(Dish::class, 'category_id');
    }

    /**
     * Scope pour récupérer uniquement les catégories actives.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Vérifie si une catégorie est active.
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->is_active;
    }

}
