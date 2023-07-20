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

    public function material()
    {
        return $this->belongsTo(Product::class, 'material_id', 'id');
    }
}
