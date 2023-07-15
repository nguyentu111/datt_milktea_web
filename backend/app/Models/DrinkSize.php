<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;

class DrinkSize extends Model
{
    use HasFactory;
    protected $table = 'drink_sizes';
    protected $casts = [
        'price_up_percent' => 'float',
        'active' => 'boolean',
    ];
    protected $fillable = [
        'active',
        'drink_id',
        'size_id',
        'price_up_percent'
    ];
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_details', 'drink_size_id', 'order_id')
            ->withPivot(['regular_price', 'promotion_pirce']);
    }
    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }
    public function sizes()
    {
        return $this->belongsTo(Size::class);
    }
}
