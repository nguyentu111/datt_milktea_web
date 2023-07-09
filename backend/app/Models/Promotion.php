<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'picture',
        'from_time',
        'to_time'
    ];
    public function products()
    {
        return $this->belongsToMany(Product::class, 'promotion_drinks', 'promotion_id', 'drink_id')
            ->withPivot(['pomotion_amount', 'discount']);
    }
}
