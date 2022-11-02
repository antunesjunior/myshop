<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    public function phone()
    {
        return $this->hasMany(PhoneVendor::class);
    }
    
    public function feeds()
    {
        return $this->hasMany(StockFeed::class);
    }

   /* public static function findAll()
    {
        $vendors = self::select('vendors.id, name, number')
            ->join('phone_vendors', 'vendors.id', '=', 'phone_vendors.vendor_id')
            ->get();

        return $vendors;
    }*/
}
