<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory, Sluggable;
    public const Materials = 'Materials';
    public const Drinks  = 'Drinks';
    public const Toppings = 'Toppings';

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

    public function toppings()
    {
        return $this->hasMany(Topping::class, 'drink_id', 'id');
    }
    public function recipes()
    {
        return $this->hasManyThrough(Recipe::class, DrinkSize::class, 'drink_id', 'drink_size_id', 'id', 'id');
    }
    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'drink_sizes', 'drink_id', 'size_id')
            ->withPivot(['id', 'active', 'price_up_percent']);
    }
    public function drinkSizes()
    {
        return $this->hasMany(DrinkSize::class, 'drink_id', 'id');
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
    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }
    public function uom()
    {
        return $this->belongsTo(Uom::class);
    }
    public function getCurrentImportPriceAttribute()
    {
        $id = $this->getAttribute('id');
        return ProductImPrice::query()->where('product_id', $id)->latest('apply_from')->value('price');
    }
    public function getCurrentExportPriceAttribute()
    {
        $id = $this->getAttribute('id');
        return ProductExPrice::query()->where('product_id', $id)->latest('apply_from')->value('price');
    }
    public function getLastestImportApplyFromAttribute()
    {
        $id = $this->getAttribute('id');
        return ProductImPrice::query()->where('product_id', $id)->latest('apply_from')->value('apply_from');
    }
    public function getLastestExportApplyFromAttribute()
    {
        $id = $this->getAttribute('id');
        return ProductExPrice::query()->where('product_id', $id)->latest('apply_from')->value('apply_from');
    }
    public function importPrices(): HasMany
    {
        return $this->hasMany(ProductImPrice::class);
    }
    public function exportPrices()
    {
        return $this->hasMany(ProductExPrice::class);
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
