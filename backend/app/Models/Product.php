<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'slug',
        'description',
        'picture',
        'tax_id',
        'uom_id',
        'type_id',
        'active',
    ];

    public $timestamps = false;


    public function toppings()
    {
        return $this->hasMany(Topping::class);
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'drink_sizes', 'drink_id', 'size_id')
            ->withPivot(['id', 'active', 'price_up_percent']);
    }

    public function type()
    {
        return $this->belongsTo(Types::class);
    }
    public function promotions()
    {
        return $this->belongToMany(Promotions::class, 'promotion_drinks', 'drink_id', 'promotion_id')
            ->withPivot(['promotion_amount', 'discount']);
    }
}