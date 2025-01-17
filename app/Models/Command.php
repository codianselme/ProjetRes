<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function items(): HasMany
    {
        return $this->hasMany(CommandItem::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending' => 'En attente',
            'confirmed' => 'Confirmée',
            'delivered' => 'Livrée',
            'cancelled' => 'Annulée',
            default => $this->status,
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending' => 'warning',
            'confirmed' => 'info',
            'delivered' => 'success',
            'cancelled' => 'danger',
            default => 'secondary',
        };
    }
}
