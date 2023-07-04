<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'export_id',
        'material_id',
        'amount'
    ];
    public function materials(){
        return $this->hasMany(Material::class);
    }
}
