<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrinkSize extends Model
{
    use HasFactory;
    protected $table = 'drink_sizes';

    protected $fillable = [
        'active',
        'drink_id',
        'size_id',
        'price_increase'
    ];


    public function orders(){
        return $this->belongsToMany(Order::class, 'order_details', 'drink_size_id', 'order_id')->withPivot(['total_price', 'topping_list']);
    }
    public function materials(){
        return $this->belongsToMany(Material::class, 'recipes', 'drink_size_id','material_id')->withPivot('amount');
    } 
 
}
