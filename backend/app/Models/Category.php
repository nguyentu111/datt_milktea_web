<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Sluggable;
    protected $fillable = ['name', 'picture', 'parent_id', 'slug'];
    protected $table = 'categories';
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function parentCategory()
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }
    public function childrenCategory()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
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
