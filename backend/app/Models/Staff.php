<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $table = 'staffs';
    protected $primaryKey   = 'id';
    protected $hidden = ['password'];
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'phone',
        'picture',
        'dob',
        'active',
        'branch_id',
        'email',
        'password',
    ];

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function roles(){
        return $this->hasMany(Role::class);
    }
}
