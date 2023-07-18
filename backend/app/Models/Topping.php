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
    public function product()
    {
        return $this->belongsTo(Product::class, 'material_id', 'id');
    }
    public function tax()
    {
        return $this->product->tax();
    }
}
