<?php

namespace App\Helpers;

class NumberToWords
{
    private static $units = [
        0 => "", 1 => "un", 2 => "deux", 3 => "trois", 4 => "quatre", 
        5 => "cinq", 6 => "six", 7 => "sept", 8 => "huit", 9 => "neuf"
    ];
    
    private static $teens = [
        0 => "dix", 1 => "onze", 2 => "douze", 3 => "treize", 4 => "quatorze", 
        5 => "quinze", 6 => "seize", 7 => "dix-sept", 8 => "dix-huit", 9 => "dix-neuf"
    ];
    
    private static $tens = [
        0 => "", 1 => "dix", 2 => "vingt", 3 => "trente", 4 => "quarante", 
        5 => "cinquante", 6 => "soixante", 7 => "soixante", 8 => "quatre-vingt", 9 => "quatre-vingt"
    ];

    public static function convert($number)
    {
        if ($number === 0) {
            return "zéro";
        }

        if ($number < 0) {
            return "moins " . self::convert(abs($number));
        }

        $words = [];

        // Milliards
        $billions = floor($number / 1000000000);
        if ($billions > 0) {
            $words[] = ($billions === 1 ? "un" : self::convert($billions)) . " milliard" . ($billions > 1 ? "s" : "");
            $number %= 1000000000;
        }

        // Millions
        $millions = floor($number / 1000000);
        if ($millions > 0) {
            $words[] = ($millions === 1 ? "un" : self::convert($millions)) . " million" . ($millions > 1 ? "s" : "");
            $number %= 1000000;
        }

        // Milliers
        $thousands = floor($number / 1000);
        if ($thousands > 0) {
            $words[] = $thousands === 1 ? "mille" : self::convert($thousands) . " mille";
            $number %= 1000;
        }

        // Centaines
        $hundreds = floor($number / 100);
        if ($hundreds > 0) {
            $words[] = $hundreds === 1 ? "cent" : self::convert($hundreds) . " cent";
            $number %= 100;
        }

        // Dizaines et unités
        if ($number > 0) {
            if ($number < 20) {
                $words[] = $number < 10 ? self::$units[$number] : self::$teens[$number - 10];
            } else {
                $ten = floor($number / 10);
                $unit = $number % 10;

                if ($ten === 7 || $ten === 9) {
                    // Cas particuliers : 70-79 et 90-99
                    $baseWord = self::$tens[$ten];
                    if ($unit === 1 && $ten === 7) {
                        $words[] = $baseWord . " et " . self::$teens[$unit];
                    } else {
                        $words[] = $baseWord . "-" . self::$teens[$unit];
                    }
                } else {
                    // Autres dizaines
                    $baseWord = self::$tens[$ten];
                    if ($unit === 0) {
                        $words[] = $baseWord . ($ten === 8 ? "s" : "");
                    } else if ($unit === 1 && $ten !== 8) {
                        $words[] = $baseWord . " et " . self::$units[$unit];
                    } else {
                        $words[] = $baseWord . "-" . self::$units[$unit];
                    }
                }
            }
        }

        // Gestion des règles spéciales pour "cent" et "vingt"
        $result = implode(" ", $words);
        
        // Règle pour "cents" au pluriel
        if (preg_match('/^(.+) cent$/', $result) && !preg_match('/^un cent$/', $result)) {
            $result .= "s";
        }

        return $result;
    }
}