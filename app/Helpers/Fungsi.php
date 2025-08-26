<?php

namespace App\Helpers;

class Fungsi
{
    public static function rupiah($amount, $prefix = 'Rp. ')
    {
        return $prefix . number_format($amount, 0, ',', '.');
    }
}
