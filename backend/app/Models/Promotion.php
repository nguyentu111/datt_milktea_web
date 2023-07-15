<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory, Sluggable;
    protected $fillable = [
        'name',
        'slug',
        'picture',
        'from_time',
        'to_time'
    ];
    public function products()
    {
        return $this->belongsToMany(Product::class, PromotionDrink::class, 'promotion_id', 'drink_id')
            ->withPivot(['promotion_amount', 'discount']);
    }
    public function promotionDrink()
    {
        return $this->hasMany(PromotionDrink::class);
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['name']
            ]
        ];
    }
}
