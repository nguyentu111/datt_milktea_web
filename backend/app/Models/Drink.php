<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    use HasFactory;

    protected $table = 'drinks';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'picture',
        'tax_id',
        'image',
        'active',
        'tod_id'
    ];

    public $timestamps = false;

  
    public function toppings(){
        return $this->hasMany(Topping::class);
    }

    public function sizes(){
        return $this->belongsToMany(Size::class, 'drink_sizes', 'drink_id', 'size_id')
        ->withPivot(['id','active','price_increase']);
    }

    public function typeOfDrink(){
        return $this->belongsTo(TypeOfDrink::class,'tod_id','id');
    }
    public function sales(){
        return $this->belongToMany(Sale::class,'sale_drinks','drink_id','sale_id')->withPivot('sale_price');
    }
}
