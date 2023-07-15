<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionDrink extends Model
{
    use HasFactory;
    protected $casts = [
        'promotion_amount' => 'float',
        'discount' => 'float'
    ];
    protected $fillable = [];
}
