<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'phone',
    ];
    public function supplyRequests(){
        return $this->hasMany(SupplyRequest::class);
    }
}
