<?php

namespace App\Models;

use App\Helpers\ProductHelper;
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
        'category_id',
        'stock_id',
        'detach',
        'show'
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    public function stockFeed()
    {
        return $this->hasMany(StockFeed::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public static function search($key)
    {
        return self::where('name', 'LIKE',"%{$key}%")
                    ->orWhere('brand', 'LIKE',"%{$key}%");
    }

    public static function userSearch($key)
    {
        return self::getByEnoughtStockQuantity()->where('name', 'LIKE',"%{$key}%")
                    ->orWhere('brand', 'LIKE',"%{$key}%");
    }

    public static function getByEnoughtStockQuantity()
    {
        return self::join('stock', 'products.id', '=', 'stock.id')
                    ->where('show', 1)
                    ->where('qtd_prod', '>', ProductHelper::STOCK_LIMIT);
    }
}
