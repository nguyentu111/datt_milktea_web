<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'customer_id',
        'cheff_id',
        'branch_id',
        'ship_to',
        'ship_note',
        'shipped_at',
        'ship_amount',
        'tax_amount',
        'cheff_id',
        'payment_type',
        'bill_url',
        'ship_amount',
        'total_amount',
        'is_paid',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function cheff()
    {
        return $this->hasOne(Staff::class, 'id', 'cheff_id');
    }

    public function drinkSizes()
    {
        return $this->belongsToMany(DrinkSize::class, 'order_details',  'order_id', 'drink_size_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
