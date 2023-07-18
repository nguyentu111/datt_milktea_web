<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchMaterial extends Model
{
    use HasFactory;
    // protected $table = 'branch_materials';
    // protected $primaryKey   = ['branch_id', 'material_id'];
    protected $casts = ['amount' => 'float'];
    protected $fillable = [
        'branch_id',
        'material_id',
        'amount',
    ];
}
