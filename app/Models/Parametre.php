<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametre extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 
        'name',
        'address',
        'contact_phone_1',
        'contact_phone_2',
        'contact_phone_3',
        'email',
        'website',
        'description',
        'facebook',
        'twitter',
        'instagram',
        'youtube',
    ];
}
