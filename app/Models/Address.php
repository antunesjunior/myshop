<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'muni', 
        'bairro', 
        'rua', 
        'user_id', 
        'province_id'
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
