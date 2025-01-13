<?php

namespace App\Helpers;

class NumberToWords
{
    public static function convert($number)
    {
        $units = ["", "un", "deux", "trois", "quatre", "cinq", "six", "sept", "huit", "neuf"];
        $tens = ["", "dix", "vingt", "trente", "quarante", "cinquante", "soixante", "soixante-dix", "quatre-vingt", "quatre-vingt-dix"];
        $teens = ["dix", "onze", "douze", "treize", "quatorze", "quinze", "seize", "dix-sept", "dix-huit", "dix-neuf"];
        
        if ($number === 0) {
            return "zéro";
        }

        $words = "";
        
        // Milliards
        if ($number >= 1000000000) {
            $words .= self::convert(floor($number / 1000000000)) . " milliard" . (floor($number / 1000000000) > 1 ? "s" : "") . " ";
            $number %= 1000000000;
        }
        
        // Millions
        if ($number >= 1000000) {
            $words .= self::convert(floor($number / 1000000)) . " million" . (floor($number / 1000000) > 1 ? "s" : "") . " ";
            $number %= 1000000;
        }
        
        // Milliers
        if ($number >= 1000) {
            $thousands = floor($number / 1000);
            if ($thousands === 1) {
                $words .= "mille ";
            } else {
                $words .= self::convert($thousands) . " mille ";
            }
            $number %= 1000;
        }
        
        // Centaines
        if ($number >= 100) {
            if (floor($number / 100) === 1) {
                $words .= "cent ";
            } else {
                $words .= $units[floor($number / 100)] . " cent ";
            }
            $number %= 100;
        }
        
        // Dizaines et unités
        if ($number >= 10) {
            if ($number < 20) {
                $words .= $teens[$number - 10];
                return trim($words);
            }
            
            $ten = floor($number / 10);
            $unit = $number % 10;
            
            if ($ten === 7 || $ten === 9) {
                $words .= $tens[$ten-1];
                if ($unit === 1) {
                    $words .= " et ";
                } else {
                    $words .= "-";
                }
                $words .= $teens[$unit];
                return trim($words);
            }
            
            $words .= $tens[$ten];
            if ($unit > 0) {
                if ($ten !== 8 && $unit === 1) {
                    $words .= " et ";
                } else {
                    $words .= "-";
                }
                $words .= $units[$unit];
            }
            if ($ten === 8 && $unit === 0) {
                $words .= "s";
            }
        } else if ($number > 0) {
            $words .= $units[$number];
        }
        
        return trim($words);
    }
}