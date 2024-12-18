<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserToken extends Model
{
    use HasFactory;

    protected $fillable=[
        'value',
        'expire_at',
        'expired',
        // 'expire_at', 
        'user_id',
    ];

    public function User(){
        return $this->belongsTo('App\Models\User');
    }
}
