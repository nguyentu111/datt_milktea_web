<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    protected $primaryKey   = ['drink_detail_id', 'order_id'];

    protected $fillable = [
        'drink_detail_id',
        'order_id',
        'regular_price',
        'promotion_price',
    ];

    public $timestamps = false;


    protected $casts = [
        'topping_list' => 'array'
    ];
    public function drink()
    {
        return $this->hasOneThrough(Drink::class, DrinkSize::class);
    }
    public function orderToppings()
    {
        return $this->belongsToMany(Topping::class, 'order_toppings', 'order_detail_id', 'topping_id')
            ->withPivot('price');
    }
}
