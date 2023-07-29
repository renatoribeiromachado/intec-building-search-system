<?php

use Carbon\Carbon;

if (! function_exists('convertPtBrDateToEnDate')) {
    function convertPtBrDateToEnDate($date)
    {
        if ($date) {
            return Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        }
        return null;
    }
}

if (! function_exists('convertMaskToDecimal')) {
    function convertMaskToDecimal(string $getValue)
    {
        $source = array('.', ',');
        $replace = array('', '.');
        $valueConverted = str_replace($source, $replace, $getValue);

        return $valueConverted;
    }
}

if (! function_exists('convertDecimalToBRL')) {
    function convertDecimalToBRL($value)
    {
        if (! is_null($value) || (! empty($value))) {
            $BRLValue = number_format($value, 2, ',', '.');
            return $BRLValue;
        }
        return 0;
    }

}