<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    public const DRINK = 'drink';
    public const MATERIAL = 'material';
    public const TOPPING = 'topping';
    protected $fillable = ['type'];
    protected $table = 'types';
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
