<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $casts = [
        'amount' => 'float'
    ];
    protected $fillable = [
        'drink_size_id',
        'material_id',
        'amount'
    ];

    public function materials()
    {
        return $this->hasMany(Product::class, 'id', 'material_id');
    }
}
