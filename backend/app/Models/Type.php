<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory, Sluggable;
    protected $fillable = ['name', 'picture', 'parent_id', 'slug'];
    protected $table = 'types';
    public const DEFAULT_TYPES = ['Drinks', 'Materials', 'Toppings'];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function parentType()
    {
        return $this->hasOne(Type::class, 'id', 'parent_id');
    }
    public function childrenType()
    {
        return $this->hasMany(Type::class, 'parent_id', 'id');
    }
    public function canModdify(): bool
    {
        return !in_array($this->getAttribute('name'), Type::DEFAULT_TYPES);
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
