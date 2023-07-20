<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    protected $fillable = [
        'drink_size_id',
        'order_id',
        'regular_amount',
        'promotion_amount',
    ];

    public $timestamps = false;
    public function toppings()
    {
        return $this->belongsToMany(Topping::class, 'order_toppings', 'order_detail_id', 'topping_id');
    }
    public function drinkSize()
    {
        return $this->belongsTo(DrinkSize::class);
    }
}
