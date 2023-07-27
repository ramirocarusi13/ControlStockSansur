<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTransfer extends Model
{
    use HasFactory;

    protected $table = 'product_transfers';

    protected $fillable = [
        'previous_stock',
        'new_stock',
        'comment',
        'active'
    ];
}
