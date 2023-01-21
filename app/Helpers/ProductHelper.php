<?php

namespace App\Helpers;

use App\Helpers\Traits\ImageHandler;
use App\Models\User;
use Illuminate\Support\Str;

class ProductHelper
{
   
   use ImageHandler;

   const STOCK_LIMIT = 20;
   const PER_PAGE_ADMIN = 8;
   const PER_PAGE_CATALOGUE = 21;

   protected static $imagePath = "public/products/cover";

}