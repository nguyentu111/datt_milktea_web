<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $hidden = ['password'];
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
    ];
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function likedDrinks()
    {
        return $this->belongsToMany(Drink::class, 'linked_drinks', 'customer_id', 'drink_id');
    }
    public function infomation(): Attribute
    {
        return Attribute::make(
            get: function (): array {
                $addresses = $this->addresses();
                return ['addresses' => $addresses];
            }
        );
    }
}
