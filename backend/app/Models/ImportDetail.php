<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportDetail extends Model
{
    use HasFactory;
    protected $casts = [
        // 'price' => 'int' 
    ];
    protected $fillable = [
        'material_id',
        'import_id',
        'amount',
        'price'
    ];
    public function import()
    {
        return $this->belongsTo(Import::class);
    }
}
