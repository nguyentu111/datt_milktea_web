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
        'branch_source',
        'brach_des'
    ];
    public function importDetails()
    {
        return $this->hasMany(ImportDetail::class);
    }
    public function products()
    {
        return $this->belongsToMany(Products::class, 'import_details', 'import_id', 'material_id');
    }
}
