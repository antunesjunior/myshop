<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Str;

class DateHelper
{
    public static function getMonths()
    {
        $months = [
            'Janeiro', 
            'Fevereiro', 
            'Marco', 
            'Abril', 
            'Maio', 
            'Junho', 
            'Julho', 
            'Agosto', 
            'Setembro', 
            'Outubro', 
            'Novembro', 
            'Dezembro'
        ];
        return $months;
    }
}