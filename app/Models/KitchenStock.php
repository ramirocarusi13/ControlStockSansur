<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KitchenStock extends Model
{
    use HasFactory;

    protected $table = 'kitchen_stock';

    protected $fillable = [
        'kitchen_id',
        'stock',
        'location',
        'status',
        'active',
    ];
}
