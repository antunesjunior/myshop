<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'sup_category_id'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function supCategory()
    {
        return $this->belongsTo(SupCategory::class);
    }
}
