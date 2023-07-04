<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    use HasFactory;
    protected $fillable = [
        'supply_detail_id',
        'staff_id',
        'amount',
    ];
    public function supplyDetails(){
        return $this->belongsTo(SupplyDetail::class);
    }
    // public function materials(){
    //     return $this->belongsToMany(Materials::class,'');
    // }
}
