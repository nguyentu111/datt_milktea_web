<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $table = 'branches';
    protected $primaryKey   = 'id';

    protected $fillable = [
        'name',
        'address',
        'phone',
        'picture',
        'date_open',
        'active',
    ];

    public $timestamps = false;

    public function materials(){
        return $this->belongsToMany(Material::class, 'branch_materials','branch_id', 'material_id' )->withPivot('amount');
    }

    public function staffs(){
        return $this->hasMany(Staff::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function exports() {
        return $this->hasMany(Export::class,'branch_source_id');
    }
    public function supplyRequest(){
        return $this->hasMany(SupplyRequest::class,'branch_id');
    }
}
