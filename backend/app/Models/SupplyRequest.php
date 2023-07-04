<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplyRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'provider_id',
        'staff_id',
        'branch_id'
    ];
    public function material(){
        return $this->belongsToMany(Material::class,'supply_details','supply_id','material_id');
    }
}
