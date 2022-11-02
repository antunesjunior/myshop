<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'brand',
        'stock', 
        'cover',
        'description',
        'vendor_id',
        'category_id'
    ];

    public function stock()
    {
        return $this->hasOne(Stock::class);
    }

    public function stockFeed()
    {
        return $this->hasMany(StockFeed::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
}
