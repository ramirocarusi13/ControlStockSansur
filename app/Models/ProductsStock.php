<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KitchenStock extends Model
{
    use HasFactory;

    protected $table = 'product_stock';

    protected $fillable = [
        'product_id',
        'stock',
        'location',
        'status',
        'active',
    ];
}
