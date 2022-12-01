<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'address_id'];

    public function shop()
    {
        return $this->hasMany(shop::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
