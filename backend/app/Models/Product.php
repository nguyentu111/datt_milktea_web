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
    protected $casts = [
        'promotions.pivot.promotion_amount' => 'float',
        'promotions.pivot.discount' => 'float',
    ];
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
    public function availableToppings()
    {
        return $this->toppings()->where('active', true)->whereHas('product', function ($query) {
            $query->where('active', true);
        })->with('product');
    }
    public function recipes()
    {
        return $this->hasManyThrough(Recipe::class, DrinkSize::class, 'drink_id', 'drink_size_id', 'id', 'id');
    }
    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'drink_sizes', 'drink_id', 'size_id')->withPivot('price_up_percent');
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
        return $this->belongsToMany(Promotion::class, 'promotion_drinks', 'drink_id', 'promotion_id')
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
    public function currentExportPrice()
    {
        $id = $this->getAttribute('id');
        return ProductExPrice::query()->where('product_id', $id)->where('apply_from', '<=', date("Y-m-d H:i:s"))->orderByDesc('apply_from')->first()->price;
    }
    public function getCurrentExportPriceAttribute()
    {
        $id = $this->getAttribute('id');
        return ProductExPrice::query()->where('product_id', $id)->latest('apply_from')->value('price');
    }
    public function currentPromotionPrice()
    {
        $currentPromotion =  $this->promotions()->where('from_time', '<=', date("Y-m-d H:i:s"))
            ->where('to_time', '>', date("Y-m-d H:i:s"))->first();
        if (!$currentPromotion) return null;
        return $currentPromotion->pivot->promotion_amount ? round($currentPromotion->pivot->promotion_amount, -3) :
            round(floatval($this->currentExportPrice) - (floatval($currentPromotion->pivot->discount) * floatval($this->currentExportPrice)), -3);
    }
    public function importPrices(): HasMany
    {
        return $this->hasMany(ProductImPrice::class);
    }

    public function exportPrices()
    {
        return $this->hasMany(ProductExPrice::class);
    }
    // public function getCurrentPromotionAttribute(): Attribute
    // {
    //     return Attribute::make(get: function () {
    //         return $this->promotions()->where('from_time', '<=', date("Y-m-d H:i:s"))->where('to_time', '>', date("Y-m-d H:i:s"))->first()->get();
    //     });
    // }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['name']
            ]
        ];
    }
}
