<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'price',
        'apply_from'
    ];
}
