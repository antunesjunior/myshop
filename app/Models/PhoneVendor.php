<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneVendor extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'vendor_id'];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
