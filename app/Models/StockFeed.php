<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockFeed extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'vendor_id', 'qtd_prod'];

    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
