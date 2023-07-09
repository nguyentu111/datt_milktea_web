<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'role'
    ];

    public $timestamps = false;

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
