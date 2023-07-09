<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    public const DEFAULT_PASSWORD = 'asdasd123';
    use HasApiTokens;
    protected $hidden = ['password'];
    protected $fillable = [
        'customer_id',
        'staff_id',
        'email',
        'password'
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function isAdmin()
    {
        return Role::where(['user_id' => $this->id, 'role' => 'admin'])->exists();
    }
    public function staff()
    {
        return $this->belongsTo(Satff::class);
    }
}
