<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topping extends Model
{
    use HasFactory;
    protected $table = 'toppings';
    protected $primaryKey   = 'id';
    protected $casts = [
        'amount' => 'float'
    ];
    protected $fillable = [
        'material_id',
        'drink_id',
        'active',
        'amount'
    ];

    public $timestamps = false;

    public function drink()
    {
        return $this->belongsTo(Drink::class);
    }
    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
