<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id',
        'staff_id',
        'branch_source_id',
        'branch_des_id'
    ];
    public function importDetails()
    {
        return $this->hasMany(ImportDetail::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'import_details', 'import_id', 'material_id')->withPivot(['amount']);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
    public function branchSource()
    {
        return $this->belongsTo(Branch::class, 'branch_source_id', 'id');
    }
    public function branchDes()
    {
        return $this->belongsTo(Branch::class, 'branch_des_id', 'id');
    }
}
