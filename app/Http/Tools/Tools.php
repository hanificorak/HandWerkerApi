<?php

namespace App\Http\Tools;
use Illuminate\Support\Str;

class Tools
{
    public static function codeGenerate(int $step = 6, bool $is_number = false): string
    {
        if ($is_number) {
            // Sadece rakam
            $min = (int) pow(10, $step - 1);
            $max = (int) pow(10, $step) - 1;

            return (string) random_int($min, $max);
        }

        // Harf + rakam (büyük harf)
        return strtoupper(Str::random($step));
    }
}
