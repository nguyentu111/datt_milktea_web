<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Export extends Model
{
    use HasFactory;
    protected $fillable = [
        'staff_id',
        'branch_source_id',
        'branch_des_id',
    ];
    public function staffs(){
        return $this->belongsTo(Staff::class);
    }
    public function exportDetails(){
        return $this->hasMany(ExportDetails::class);
    }
    public function materials(){
        return $this->belongsToMany(Material::class,'export_details','export_id','material_id');
    }
}
