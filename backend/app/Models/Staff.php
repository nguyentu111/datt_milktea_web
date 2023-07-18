<?php

namespace App\Models;

use DebugBar\DebugBar;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function Psy\debug;

class Staff extends Model
{
    use HasFactory;
    protected $table = 'staffs';
    protected $primaryKey   = 'id';
    // protected $cast = ['active' => 'boolean'];
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'phone',
        'picture',
        'dob',
        'active',
        'branch_id',
    ];
    // public function email() :Attribute{
    //     return Attribute::make(
    //         get : fn()=>{
    //             $user = 
    //         }
    //     )
    // }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function roles()
    {
        return $this->hasManyThrough(Role::class, User::class);
    }
    public function isAdmin()
    {
        $roles =  $this->roles()->where(['role' => 'admin'])->exists();

        return  $roles;
    }
    public function isWarehouseManager()
    {
        $roles =  $this->roles()->where(['role' => 'warehouse_manager'])->exists();

        return  $roles;
    }
    public function isBusinessManager()
    {
        $roles =  $this->roles()->where(['role' => 'business_manager'])->exists();

        return  $roles;
    }
    public function isCheff()
    {
        $roles =  $this->roles()->where(['role' => 'cheff'])->exists();

        return  $roles;
    }
    public function isCashier()
    {
        $roles =  $this->roles()->where(['role' => 'cashier'])->exists();

        return  $roles;
    }
    public function hasRole($role)
    {
        $exist =  $this->roles()->where(['role' => $role])->exists();

        return  $exist;
    }
    public function getFullNameAttribute()
    {
        return $this->getAttribute('first_name') . ' ' . $this->getAttribute('last_name');
    }
}
